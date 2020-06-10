<nav class="navbar navbar-expand-md fixed-top">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item">
                <a href="tel:+33607491112" type="phone" class="nav-link">
                    <i class="ri-phone-line"></i> <b>06.07.49.11.12</b>
                </a>
            </li>
            <li class="nav-item">
                <a rel="noopener noreferrer" target="_blank"
                    href="https://www.google.fr/maps/place/Lamb%C3%A9zellec,+Brest/@48.4286861,-4.5321217,13z/data=!3m1!4b1!4m5!3m4!1s0x4816bb9d6a0111e3:0x2cb271f8c2e20c5f!8m2!3d48.4262999!4d-4.4903012"
                    type="phone" class="nav-link">
                    <i class="ri-map-pin-2-line"></i> <b>Brest, Lambé</b>
                </a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <ul class="mr-auto nav__items">
            <li class="align-li">
                <nuxt-link class="nav-link" to="/#galerie">
                    <b>
                        Galerie
                    </b>
                </nuxt-link>
            </li>
            <li class="align-li pdecal">
                <nuxt-link class="nav-link" to="/#tarifs">
                    <b>
                        Tarifs
                    </b>
                </nuxt-link>
            </li>
            <li class="align-li nav__items pdecal">
                <a class="nav-link pdecal" style="margin-top:4px">
                    <i style="cursor:pointer;" class="ri-menu-line navbar-toggler" data-toggle="collapse"
                        data-target=".dual-collapse2"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse w-75 order-3 dual-collapse2"></div>
</nav>
<style>
@media screen and (min-width: 360px) {
    .pdecal {
        padding-left: 70px;
    }
}

.nav__items {
    padding-left: 0;
    display: flex;
    margin-bottom: 0;
    list-style: none;
}

.align-li {
    display: table-cell;
}

nav {
    min-height: 70px;
    width: 100%;
    background: #fffbf8;
    color: black;
    font-family: "Open Sans Condensed", sans-serif;
    box-shadow: 0 0 5px 2px #ffe6e6c0;
}

nav a {
    font-family: "Open Sans Condensed", sans-serif;
    text-decoration: none;
    font-size: 23px;
    color: rgb(85, 85, 85);
}

nav a:hover {
    color: #ffc4c6;
}

nav h1 {
    color: black;
    line-height: 55px;
    margin-left: 25px;
}

nav h4 {
    color: black;
    line-height: 70px;
    margin-right: 25px;
}
</style>