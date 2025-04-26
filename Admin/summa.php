<table class="datatable" id="registered-table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Phonenumber</th>
                                        <th>Userid</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $s ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['phoneno']; ?></td>
                                            <td><?php echo $row['userid']; ?></td>
                                            <td><?php echo $row['password']; ?></td>

                                            <td class="action-buttons">

                                            </td>
                                        </tr>
                                    <?php
                                        $s++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="Adduser">
                                    <div class="modal-body">
                                    <label for="Name">Name</label><br>
                                        <input type="text" id="Name" name="Names" class="form-control" placeholder="Enter your Name" required><br>

                                        <label for="phoneno">Phoneno</label><br>
                                        <input type="text" id="phoneno" name="phoneno" class="form-control" placeholder="Enter your phoneno" required><br>

                                        <label for="userid">Userid</label><br>
                                        <input type="text" id="userid" name="userid" class="form-control" placeholder="Enter your Userid" required><br>

                                        <label for="password">Password</label><br>
                                        <input type="text" id="password" name="password" class="form-control" placeholder="Enter your password" required><br>

                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>