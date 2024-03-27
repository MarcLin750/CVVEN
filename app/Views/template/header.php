<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVVEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        * {
            font-family: 'Poppins', 'sans-serif';
        }
        .h-font {
            font-family: 'Merienda' , cursive;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

       
        input[type=number] {
        -moz-appearance: textfield;
        }
        
        .custom-bg{
            background-color: #2ec1ac;
            border:1px solid #2ec1ac ;
        }
        .custom-bg:hover{
            background-color: #279e8c;
            border-color: #279e8c;
        }
        .availability-form {
            margin-top: -100px;
            z-index: 2;
            position: relative;
            width: 80%; /* Ajoutez cette règle pour ajuster la largeur */
            margin-left: auto; /* Centrer horizontalement */
            margin-right: auto; /* Centrer horizontalement */
        }
        @media screen  and (max-width:575px) {
            .availability-form {
            margin-top: 25px;
            padding:0 35px;
            
        }
            
        }


    </style>
</head>
<body class="bg-light">


<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">CVVEN</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">Chambres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities-page">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="#">About</a>
                </li>
            </ul>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-person-circle fs-3 me-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                        User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Login</button>
                        <a href="javascript:void(0)" class="text-secondary text-decoration-none">Forgot Password</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-person-lines-fill fs-3 me-2" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                        </svg>
                        User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with you ID (Identity card, Passport, Driving license, etc.)
                        that will be required during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class= "row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone number</label>
                                <input type="number" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-6 p-0  mb-3">
                                <label class="form-label">Picture</label>
                                <input type="file" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-12 p-0  mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none"  rows="1"></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="number" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-6 p-0">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control shadow-none"> 
                            </div>
                            <div class="col-md-6 p-0  mb-3">
                                <label class="form-label">Confirm password</label>
                                <input type="password" class="form-control shadow-none"> 
                            </div>
                        </div>
                        <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
