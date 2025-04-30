from flask import Flask, render_template, redirect, url_for, request, session, flash
from models import db, User
from werkzeug.security import generate_password_hash, check_password_hash
from flask_socketio import SocketIO, emit
from flask_migrate import Migrate
from datetime import datetime
import pandas as pd

app = Flask(__name__)
app.secret_key = 'your_secret_key'
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///database.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

app.config['SECRET_KEY'] = 'secret!'
socketio = SocketIO(app, async_mode='eventlet')

auction_data = {
    "item": "Vintage Painting",
    "highest_bid": 0,
    "highest_bidder": None,
    "highest_bidder_id": 0
}

link = {
    "m": "",
    "k": "",
    "c": "",
    "e": "",
}

migrate = Migrate(app, db)
db.init_app(app)

# Initialize the database
with app.app_context():
    db.create_all()

@app.route('/')
def home():
    return redirect(url_for('login'))

@socketio.on('new_bid')
def handle_new_bid(data):
    if 'user_id' not in session or session.get('is_admin'):
        return redirect(url_for('login'))
    user = User.query.get(session['user_id']) 
    amount = int(data['amount'])

    user_points = user.hacker_rank_points
    
    if amount > auction_data['highest_bid'] and user_points > amount:
        auction_data['highest_bid'] = amount
        auction_data['highest_bidder'] = user.username
        auction_data['highest_bidder_id'] = user.id
        emit('bid_update', auction_data, broadcast=True)
    else:
        emit('bid_error', {'message': 'Bid too low! or less hacker points'}, room=request.sid)

@socketio.on('auction_bid')
def handle_auction_bid(data):
    bidder = data['auctionInput']
    auction_data["item"] = bidder
    emit('auction_update', auction_data, broadcast=True)


@socketio.on('linkUpdate')
def handle_link_update(data):
    m = data['m']
    k = data['k']
    c = data['c']
    e = data['e']
    
    link["m"] = m
    link["k"] = k
    link["c"] = c
    link["e"] = e
    emit('linkUpdates', link, broadcast=True)


@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        email = request.form['email']
        username = request.form['username']
        password = request.form['password']
        team_members = request.form['team_members']

        # Check if email already exists
        if User.query.filter_by(email=email).first():
            return render_template('register.html', error="Email already exists. Please use a different one.")

        # Check if username already exists
        if User.query.filter_by(username=username).first():
            return render_template('register.html', error="Username already taken. Choose another.")

        # If all good, create user
        hashed_password = generate_password_hash(password, method='pbkdf2:sha256')
        new_user = User(email=email, username=username, password=hashed_password, team_members=team_members)
        db.session.add(new_user)
        db.session.commit()
        flash('Registration successful. Please log in.', 'success')
        return redirect(url_for('login'))

    return render_template('register.html')



@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        user = User.query.filter_by(username=username).first()

        if user and check_password_hash(user.password, password):
            session['user_id'] = user.id
            session['is_admin'] = user.is_admin
            if user.is_admin:
                return redirect(url_for('admin_dashboard'))
            else:
                return redirect(url_for('user_dashboard'))
        else:
            flash('Invalid Credentials', 'danger')

    return render_template('login.html')

# Initialize the database
def create_default_admin():
    with app.app_context():
        db.create_all()

        admin_username = 'code_rewind_admin'
        admin_email = 'admin@gmail.com'
        admin_password = 'code_rewind_admin'

        admin_user = User.query.filter_by(username=admin_username).first()
        if not admin_user:
            hashed_password = generate_password_hash(admin_password, method='pbkdf2:sha256')
            new_admin = User(
                email=admin_email,
                username=admin_username,
                password=hashed_password,
                team_members='Admin',
                is_admin=True
            )
            db.session.add(new_admin)
            db.session.commit()



@app.route('/user_dashboard')
def user_dashboard():
    if 'user_id' not in session or session.get('is_admin'):
        return redirect(url_for('login'))
    user = User.query.get(session['user_id']) 
    all_users = User.query.all() # Get the logged-in user from the database
    return render_template('user_dashboard.html', user=user, all_users=all_users)


@app.route('/bid_detected_points', methods=['GET', 'POST'])
def bid_detected_points():
    if request.method == 'POST':
        userid = request.form['bid_user_id']
        highestBid_get = request.form['bid_user_bid']
    user = User.query.get(userid) 
    user.detected_points = int(highestBid_get)
    user.hacker_rank_points = int(user.hacker_rank_points) - int(highestBid_get)
    db.session.commit()
    users = User.query.all()
    users_update_open = User.query.all()
    for user in users_update_open:
        user.isOpen = 1 
    db.session.commit()
    return render_template('admin_dashboard.html', user=users)


@app.route('/admin_dashboard')
def admin_dashboard():
    if 'user_id' not in session or not session.get('is_admin'):
        return redirect(url_for('login'))
    users = User.query.all()
    return render_template('admin_dashboard.html', users=users)

@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('login'))

@app.route("/indexcards")
def index():
    if 'user_id' not in session or session.get('is_admin'):
        return redirect(url_for('login'))
    user = User.query.get(session['user_id'])  # Get the logged-in user from the database
    return render_template('index.html', user=user)

@app.route("/bids")
def bids():
    if 'user_id' not in session or session.get('is_admin'):
        return redirect(url_for('login'))
    user = User.query.get(session['user_id'])  # Get the logged-in user from the database
    return render_template('bid.html', user=user, auction=auction_data)



@app.route('/delete_user', methods=['POST'])
def delete_user():
    user_id = request.form.get('user_id')

    if user_id:
        try:
            user = User.query.get(user_id)
            if user:
                db.session.delete(user)
                db.session.commit()
                return redirect(url_for('admin_dashboard'))  # replace 'your_users_page' with your listing page
            else:
                return "User not found", 404
        except Exception as e:
            print(e)
            db.session.rollback()
            return "Error deleting user", 500
    return "No user ID provided", 400





@app.route('/update', methods=['GET'])
def update():
    users = User.query.all()
    for user in users:
        user.fairness = 1000 
    db.session.commit()
    return "Users updated successfully!"
def get_updated_fairness_points(user):
    if user.fairness_points is None:
        user.fairness_points = 1000
    if user.last_updated_time is None:
        user.last_updated_time = datetime.utcnow()
    now = datetime.utcnow()
    elapsed_seconds = (now - user.last_updated_time).total_seconds()
    updated_points = min(user.fairness_points + int(elapsed_seconds), 1000)
    return updated_points

@app.route('/reduce_points', methods=['POST'])
def reduce_points():
    user_id = request.form.get('user_id')
    points_to_reduce = int(request.form.get('points'))
    user = User.query.get(user_id)
    if user:
        if user.fairness_points is None:
            user.fairness_points = 1000
        user.fairness_points = max(user.fairness_points - points_to_reduce, 0)
        db.session.commit()
        return redirect(url_for('admin_dashboard'))
    return "User not found", 404

# Update fairness points for a specific user
@app.route('/update_fairness_points', methods=['POST'])
def update_fairness_points():
    user_id = request.form.get('user_id')
    user = User.query.get(user_id)
    if user:
        user.fairness_points = get_updated_fairness_points(user)
        user.last_updated_time = datetime.utcnow()
        db.session.commit()
    return redirect(url_for('admin_dashboard'))

# Update fairness points for ALL users
@app.route('/update_all_fairness_points', methods=['POST'])
def update_all_fairness_points():
    users = User.query.all()
    for user in users:
        user.fairness_points = get_updated_fairness_points(user)
        user.last_updated_time = datetime.utcnow()
    db.session.commit()
    return redirect(url_for('admin_dashboard'))

@app.route('/leaderboard')
def leaderboard():
    users = User.query.all()
    # Calculate total points for each user
    leaderboard_data = [
        {
            'username': user.username,
            'email': user.email,
            'hacker_rank_points': user.hacker_rank_points,
            'detected_points': user.detected_points,
            'fairness_points':user.fairness_points,
            'total_points': ((int(user.hacker_rank_points) if user.hacker_rank_points else 0 + int(user.detected_points) if user.detected_points else 0) + int(user.fairness_points/100) if user.fairness_points else 10)
        }
        for user in users
    ]
    # Sort by total points descending
    leaderboard_data.sort(key=lambda x: x['total_points'], reverse=True)
    return render_template('leaderboard.html', leaderboard_data=leaderboard_data)

@app.route('/admin/upload', methods=['GET', 'POST'])
def admin_upload():
    if request.method == 'POST':
        file = request.files['csv_file']
        
        if file and file.filename.endswith('.csv'):
            # Read CSV into a pandas DataFrame
            df = pd.read_csv(file)

            # Assuming CSV has columns: 'email' and 'hacker_rank_points'
            if 'email' not in df.columns or 'hacker_rank_points' not in df.columns:
                flash("CSV must have 'email' and 'hacker_rank_points' columns", 'error')
                return redirect(url_for('admin_upload'))
            
            # Get the list of emails from the CSV
            csv_emails = set(df['email'].dropna())

            # Get the list of emails from the database
            db_emails = set(user.email for user in User.query.all())

            # Find emails that are missing in both
            missing_in_db = csv_emails - db_emails  # Emails in CSV but not in DB
            missing_in_csv = db_emails - csv_emails  # Emails in DB but not in CSV

            # Flash missing email messages
            if missing_in_db:
                flash(f"Emails in CSV but not in DB: {', '.join(missing_in_db)}", 'error')
            if missing_in_csv:
                flash(f"Emails in DB but not in CSV: {', '.join(missing_in_csv)}", 'error')

            # Update hacker_rank_points for existing users in the database
            for index, row in df.iterrows():
                email = row['email']
                hacker_rank_points = row['hacker_rank_points']

                # Find the user by email and update hacker_rank_points
                user = User.query.filter_by(email=email).first()
                if user:
                    user.hacker_rank_points = hacker_rank_points
                    db.session.commit()

            return redirect(url_for('admin_dashboard'))  # After successful upload

    return render_template('admin_dashboard.html')


@app.route('/dummyupdate', methods=["GET", "POST"])
def dummyupdate():
    users = User.query.all()
    for user in users:
        user.isOpen = 1 if user.isOpen == 0 else 0
    db.session.commit()
    socketio.emit('auction_status_changed', {'isOpen': 0} )

    return redirect(url_for('admin_dashboard'))

if __name__ == '__main__':
    socketio.run(app, debug=True)