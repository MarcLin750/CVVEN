<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVVEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
