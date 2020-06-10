<head>
    <title>So.Ongles - Document not found</title>
    <?php require 'HEAD.php'; ?>
</head>

<body>
    <section class="instagram pb-5" id="galerie" style="min-height:100vh">
        <div style="padding-top:70px;padding-bottom:35px" class="text-center">
            <h2>Oups ..</h2>
            <h3>La ressource demandé à été déplacé ou n'est plus disponible</h3>
        </div>
        <div>
            <h1>Erreur 404</h1>
  <div class="text-center mt-5">
        <a href="./" class="text-center" style="font-size: 19px;color:#000">Revenir sur le site</a>
  </div>
          
        </div>
        <div id="tarifs"></div>
    </section>
</body>

<style>
    .page-enter-active {
        transition: all 0.3s;
    }

    .page-leave-active {
        transition: all 0.3s;
    }

    .page-enter {
        opacity: 0;
    }

    .page-leave-to {
        opacity: 0;
    }

    html,
    body {
        scroll-behavior: smooth;
        overflow-x: hidden;
    }

    body {
        background: #ffffff;
        font-size: 16px;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: "Open Sans Condensed", sans-serif;
    }

    .btn-rdv {
        border: solid 2px white;
        padding: 12px 22px;
        transition: 0.4s;
    }

    .btn-rdv:hover {
        transition: 0.4s;
        background: white;
        border: solid 2px white;
        color: #000;
        padding: 12px 22px;
    }

    a,
    a:hover {
        transition: 0.2s;
        text-decoration: none;
        color: #ffc4c6;
    }

    .a {
        font-family: "Open Sans Condensed", sans-serif;
        text-decoration: none;
        font-size: 26px;
        color: rgb(85, 85, 85);
    }

    .separator {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .separator::before,
    .separator::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #000;
    }

    .separator::before {
        margin-right: 0.25em;
    }

    .separator::after {
        margin-left: 0.25em;
    }

    @media screen and (max-width: 984px) {
        .col_none {
            display: none;
        }
    }

    @media screen and (min-width: 768px) {
        .student {
            display: block;
        }
    }

    @media screen and (max-width: 767px) {
        .student {
            display: none;
        }
    }

    .tarifs {
        background: rgb(255, 197, 197, 0.5);
        height: auto;
        font-size: 19px;
        text-align: center;
        margin: 0 auto;
    }

    .tarifs_content {
        width: 90%;
        margin: 0 auto;
    }

    .title-presentation {
        font-size: 6.5em;
        margin-top: 12rem;
        text-align: center;
        font-family: "Dancing Script", cursive;
    }

    .gallery {
        -webkit-column-count: 3;
        -moz-column-count: 3;
        column-count: 3;
        -webkit-column-width: 33%;
        -moz-column-width: 33%;
        column-width: 33%;
        width: 80%;
        margin: 0 auto;
    }

    .gallery .pics {
        -webkit-transition: all 350ms ease;
        transition: all 350ms ease;
    }

    .gallery .animation {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    @media (max-width: 450px) {
        .gallery {
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
            -webkit-column-width: 100%;
            -moz-column-width: 100%;
            column-width: 100%;
        }
    }

    @media (max-width: 400px) {
        .btn.filter {
            padding-left: 1.1rem;
            padding-right: 1.1rem;
        }
    }

    .first {
        height: 70vh;
        width: 100%;
        background: red;
        background-size: cover;
    }

    .instagram {
        background: #ffe6e67e;
        height: auto;
        width: 100%;
    }

    .instagramItems {
        height: 350px;
        width: 200px;
        border: solid 1px black;
    }

    .horaires, 
    h1,
    h2,
    h3,
    h4 {
        width: 85%;
        text-align: center;
        margin: 0 auto;
    }

    .comments {
        background: #ffe6e67e;
        color: black;
    }

    .comments_content {
        width: 90%;
        margin: 0 auto;
    }

    .comments h4 {
        color: black;
    }

    .comments .row {
        padding-bottom: 2rem;
        min-height: 25vh;
        width: 100%;
        margin: 0 auto;
        text-align: center;
        padding-top: 8vh;
    }

    .comments p {
        font-size: 19px;
        color: black;
        text-align: justify;
        width: auto;
        margin: 0 auto;
    }

    .fa-quote-right {
        color: black;
    }
</style>


<?php

require 'components/Footer.php';
