<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="Editor/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>



<script>
        $(document).ready(function() {
                <?php
                if (strpos($_SERVER['REQUEST_URI'], "/job.php")) {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        'excel'

                                ],
                                order: [
                                        [0, 'desc']
                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }


                        });
                <?php
                } else if (strpos($_SERVER['REQUEST_URI'], "/jobhistory.php")) {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        'excel'

                                ],
                                order: [
                                        [5, 'desc']
                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }

                        });
                <?php
                } else if (strpos($_SERVER['REQUEST_URI'], "/add.php")) {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        'excel'

                                ],
                                order: [
                                        [0, 'desc']
                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }


                        });
                <?php
                } else if (strpos($_SERVER['REQUEST_URI'], "/creditshistory.php")) {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        'excel'

                                ],
                                order: [
                                        [6, 'desc']
                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }

                        });
                <?php
                } else if (strpos($_SERVER['REQUEST_URI'], "/accountant.php")) {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        {
                                                extends: 'csv',
                                                text: 'Export to Excel'
                                        }

                                ],
                                order: [
                                        [0, 'desc']
                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }

                        });
                <?php
                } else if (strpos($_SERVER['REQUEST_URI'], "/refundrequest.php")) {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        'excel'

                                ],
                                order: [
                                        [0, 'desc']
                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }

                        });
                <?php
                } else {
                ?>
                        $("#myTable").DataTable({
                                dom: 'Bfrtip',
                                buttons: [


                                        'excel'

                                ],
                                initComplete: function() {
                                        var btns = $('.dt-button');
                                        btns.addClass('btn btn-success');
                                        btns.removeClass('dt-button');

                                }
                        });
                <?php
                }
                ?>

        });
</script>