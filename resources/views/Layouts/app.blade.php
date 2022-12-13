<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard - Atrana</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
    <!-- Apexcharts  CSS -->
    <link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">
</head>

<body>

    <!--Topbar -->
    <div class="topbar transition">
        <div class="bars">
            <button type="button" class="btn transition" id="sidebar-toggle">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="menu">
            <ul>
                <li class="nav-item dropdown dropdown-list-toggle">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-list">
                        <div class="dropdown-header">Notifications</div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            <div class="custome-list-notif">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        The Atrana template has the latest update!
                                        <div class="time text-primary">3 Min Ago</div>
                                    </div>
                                </a>

                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Sri asks you for friendship!
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>

                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Storage has been cleared, now you can get back to work!
                                        <div class="time">20 Hours Ago</div>
                                    </div>
                                </a>


                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Atrana Template, I hope you enjoy using this template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>

                            </div>
                        </div>

                        <div class="dropdown-footer text-center">
                            <a href="#">View All</a>
                        </div>


                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="assets/images/avatar/avatar-1.png" alt="">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i> <span>My
                                Profile</span></a>
                        <a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i>
                            <span>Settings</span></a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>My
                                Profile</span></a>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!--Sidebar-->
    <div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content">
            <div id="sidebar">

                <!-- Logo -->
                <div class="logo">
                    <h2 class="mb-0"><img src="assets/images/logo.png"> Atrana</h2>
                </div>

                <ul class="side-menu">
                    <li>
                        <a href="index.html" class="active">
                            <i class='bx bxs-dashboard icon'></i> Dashboard
                        </a>
                    </li>

                    <!-- Divider-->
                    <li class="divider" data-text="STARTER">STARTER</li>

                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            Layout
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="layout-default.html">Default Layout</a></li>
                            <li><a href="layout-top-navigation.html">Top Navigation</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="blank-pages.html">
                            <i class='bx bxs-meh-blank icon'></i>
                            Blank Page
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class='fa fa-th icon'></i>
                            Bootstrap
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="bootstrap-alert.html">Alert</a></li>
                            <li><a href="bootstrap-badge.html">Badge</a></li>
                            <li><a href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                            <li><a href="bootstrap-buttons.html">Buttons</a></li>
                            <li><a href="bootstrap-card.html">Card</a></li>
                            <li><a href="bootstrap-carousel.html">Carousel</a></li>
                            <li><a href="bootstrap-dropdown.html">Dropdown</a></li>
                            <li><a href="bootstrap-list-group.html">List Group</a></li>
                            <li><a href="bootstrap-modal.html">Modal</a></li>
                            <li><a href="bootstrap-nav.html">Navs</a></li>
                            <li><a href="bootstrap-pagination.html">Pagination</a></li>
                            <li><a href="bootstrap-progress.html">Progress</a></li>
                            <li><a href="bootstrap-spinner.html">Spinner</a></li>
                        </ul>
                    </li>

                    <!-- Divider-->
                    <li class="divider" data-text="Atrana">Atrana</li>

                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            Components
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="component-avatar.html">Avatar</a></li>
                            <li><a href="component-toastify.html">Toastify</a></li>
                            <li><a href="component-sweet-alert.html">Sweet Alert</a></li>
                            <li><a href="component-hero.html">Hero</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bxs-notepad icon'></i>
                            Forms
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="forms-editor.html">Editor</a></li>
                            <li><a href="forms-validation.html">Validation</a></li>
                            <li><a href="forms-checkbox.html">Checkbox</a></li>
                            <li><a href="forms-radio.html">Radio</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bxs-widget icon'></i>
                            Widgets
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="widgets-chatboxs.html">ChatBox</a></li>
                            <li><a href="widgets-email.html">Emails</a></li>
                            <li><a href="widgets-pricing.html">Pricing</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bxs-bar-chart-alt-2 icon'></i>
                            Charts
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="chart-chartjs.html">ChartJS</a></li>
                            <li><a href="chart-apexcharts.html">Apexcharts</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bxs-cloud-rain icon'></i>
                            Icons
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="icons-fontawesome.html">Fontawesome</a></li>
                            <li><a href="icons-boostrap.html">Bootstrap Icons</a></li>
                        </ul>
                    </li>

                    <!-- Divider-->
                    <li class="divider" data-text="Pages">Pages</li>

                    <li>
                        <a href="#">
                            <i class='bx bxs-user icon'></i>
                            Auth
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="auth-login.html">Login</a></li>
                            <li><a href="auth-register.html">Register</a></li>
                            <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                            <li><a href="auth-reset-password.html">Reset Password</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bxs-error icon'></i>
                            Errors
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="errors-403.html">403</a></li>
                            <li><a href="errors-404.html">404</a></li>
                            <li><a href="errors-500.html">500</a></li>
                            <li><a href="errors-503.html">503</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="credits.html"><i class='fa fa-pencil-ruler icon'></i>
                            Credits
                        </a>
                    </li>

                </ul>

                <div class="ads">
                    <div class="wrapper">
                        <div class="help-icon"><i class="fa fa-circle-question fa-3x"></i></div>
                        <p>Need Help with <strong>Atrana</strong>?</p>
                        <a href="docs/" class="btn-upgrade">Documentation</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div><!-- End Sidebar-->


    <div class="sidebar-overlay"></div>


    <!--Content Start-->
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Dashboard</h1>
                <p></p>
            </div>

            <div class="row">

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Revenue</p>
                                    <h5>$65</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Orders</p>
                                    <h5>3000</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fas fa-chart-bar  icon-home bg-info text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Sales</p>
                                    <h5>5500</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 d-flex align-items-center">
                                    <i class="fas fa-id-card  icon-home bg-warning text-light"></i>
                                </div>
                                <div class="col-8">
                                    <p>Employes</p>
                                    <h5>256</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div id="columnchart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Messages</h4>
                        </div>
                        <div class="card-body pb-4">
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/message/4.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Hank Schrader</h5>
                                    <h6 class="text-muted mb-0">@johnducky</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/message/5.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Dean Winchester</h5>
                                    <h6 class="text-muted mb-0">@imdean</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/message/1.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">John Doe</h5>
                                    <h6 class="text-muted mb-0">@Doejohn</h6>
                                </div>
                            </div>
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-primary font-bold mt-3'>Start
                                    Conversation</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Transaction</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order Id</th>
                                            <th scope="col">Billing Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">#SK2548 </th>
                                            <td>Neal Matthews</td>
                                            <td>07 Oct, 2022</td>
                                            <td>$400</td>
                                            <td><span class="text-success">Paid</span></td>
                                            <td>Mastercard</td>
                                            <td><button class="btn btn-primary">View Details</button></td>
                                        </tr>

                                        <tr>
                                            <th scope="row">#SK2548 </th>
                                            <td>Neal Matthews</td>
                                            <td>07 Oct, 2022</td>
                                            <td>$400</td>
                                            <td><span class="text-success">Paid</span></td>
                                            <td>Visa</td>
                                            <td><button class="btn btn-primary">View Details</button></td>
                                        </tr>

                                        <tr>
                                            <th scope="row">#SK2548 </th>
                                            <td>Neal Matthews</td>
                                            <td>07 Oct, 2022</td>
                                            <td>$400</td>
                                            <td><span class="text-danger">Chargeback</span></td>
                                            <td>Paypal</td>
                                            <td><button class="btn btn-primary">View Details</button></td>
                                        </tr>

                                        <tr>
                                            <th scope="row">#SK2548 </th>
                                            <td>Neal Matthews</td>
                                            <td>07 Oct, 2022</td>
                                            <td>$400</td>
                                            <td><span class="text-warning">Refund</span></td>
                                            <td>Visa</td>
                                            <td><button class="btn btn-primary">View Details</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="float-start">
                <p>2022 &copy; Atrana</p>
            </div>
            <div class="float-end">
                <p>Crafted with
                    <span class="text-danger">
                        <i class="fa fa-heart"></i> by
                        <a href="https://www.facebook.com/andreew.co.id/" class="author-footer">Andre Tri Ramadana</a>
                    </span>
                </p>
            </div>
        </div>
    </footer>


    <!-- Preloader -->
    <div class="loader">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Loader -->
    <div class="loader-overlay"></div>

    <!-- General JS Scripts -->
    <script src="assets/js/atrana.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/jquery/jquery.min.js"></script>
    <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="assets/modules/popper/popper.min.js"></script>

    <!-- Chart Js -->
    <script src="assets/modules/apexcharts/apexcharts.js"></script>
    <script src="assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
