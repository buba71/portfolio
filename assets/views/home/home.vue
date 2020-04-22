<template>
    <div>
        <!-- Home content -->
        <div class="container-fluid">
            <scroll-button v-if="service"></scroll-button>
            <section class="row " id="home">
                <div class="col-lg-6" id="introduction">
                    <!-- Title -->
                    <h1 id="introduction-title">Developpeur Web Freelance</h1>
                    <!-- Title -->

                    <!-- Description -->
                    <p id="introduction-paragraphe">
                       <strong>Vous êtes à la recherche d'un professionnel pour créer un site internet?
                        Vous recherchez un développeur web, freelance, pour vous épauler techniquement?
                        Ou bien vous voulez tout simplement profiter des opportunités du web pour développer votre activité?
                        Spécialisé dans le développement PHP/SYMFONY et VUE.JS/NUXT.JS, je vous accompagne dans la création
                        d'une solution web sur mesure et adaptée à votre coeur de métier en vous proposant mes compétences
                        en développement web et gestion de projet.
                        </strong><br/>
                    </p>

                    <div id="contact_link" class="text-center">
                        <a class="btn" id="contact_btn" href="#" v-scroll-to="'#contact'" style="font-family: 'Roboto Mono Medium';">Contactez-moi</a>
                    </div>
                    <!-- Description -->
                </div>

                <!-- Illustration -->
                <div class="col-lg-6 d-flex justify-content-end" id="illustration-header">

                    <div id="triangle-form" class="h-100">
                        <div id="illustration" class="d-flex justify-content-center align-items-center">
                            <img id="computer" class="" v-bind:src="'../../images/development.png'" alt="computer">
                        </div>
                    </div>

                </div>
                <!-- Illustration -->


            </section>
        </div>
        <!-- Home content -->

        <!-- Services section. -->
        <section v-view="viewServiceHandler" id="services" class="section-content">
            <div class="container">
                <div class="section-title">
                    <h2>MES SERVICES</h2>
                </div>

                <!-- First services row -->
                <div class="row services-box">
                    <transition name="fade1"  >
                        <div v-if="service" class="box col-md-6" id="services-top-left">
                            <div class="icon-box" >
                                <i class="icon icon-web-programming "></i>
                            </div>
                            <div class="box-content">
                                <h5>Développement</h5>
                                <p>Je réalise vos projets web grâce à des solutions efficaces et modernes tout en respectant vos besoins:</p>
                                <ul>
                                    <li> Site vitrine.</li>
                                    <li> Application web monopage(SPA).</li>
                                    <li> E-boutique.</li>
                                    <li> Application métier spécifique sur mesure.</li>
                                </ul>
                            </div>
                        </div>
                    </transition>

                    <transition name="fade2">
                        <div v-if="service" class="box col-md-6" id="services-top-right">
                            <div class="icon-box">
                                <i class="icon icon-laptop-4"></i>
                            </div>
                            <div class=box-content>
                                <h5>Maintenance et évolution</h5>
                                <p>
                                    Afin qu'une application ou un site web innovant reste à jour, il doit faire l'objet d'une maintenance préventive, corrective ou évolutive.
                                    Je vous propose de vous accompagner sur vos projets d'évolution, de refonte et de migration avec le souci de l'optimisation technique.
                                </p>

                            </div>
                        </div>
                    </transition>
                </div>

                <!-- First services row -->

                <!--  Second services row -->
                <div class="row services-box">
                    <transition name="fade1">
                        <div v-if="service" class="box col-md-6" id="services-bottom-left">
                            <div class="icon-box" >
                                <i class="icon icon-startup "></i>
                            </div>
                            <div class="box-content">
                                <h5>Développeur web et Agile</h5>
                                <p>Gestion de projet selon une approche pragmatique. De l'analyse des besoins jusqu'à la livraison finale
                                    de la solution, je fais appel à des méthodogies et outils modernes. Vous êtes au coeur du projet, et
                                    c'est en toute transparence que vous suivez son évolution en temps réel.

                                </p>
                            </div>
                        </div>
                    </transition>
                    <transition name="fade2">
                        <div v-if="service" class="box col-md-6" id="services-bottom-right">
                            <div class="icon-box">
                                <i class="icon icon-medal"></i>
                            </div>
                            <div class="box-content">
                                <h5>Qualité de conception</h5>
                                <p>
                                    Votre projet doit être évolutif et maintenable sur le long terme. C'est pourquoi je m'engage à respecter
                                    un ensemble de bonnes pratiques, essentielles pour obtenir un code robuste. Audits de code réguliers,
                                    mise en place de tests unitaires et fonctionnels, contrôle des performances et monitoring. Respect des standards
                                    de la W3C.
                                </p>

                            </div>
                        </div>
                    </transition>
                </div>
                <!--  Second services row -->
            </div>
        </section>
        <!-- Services section. -->

        <!-- About section. -->
        <section id="about" class="section-content">
            <div class="container">
                <div class="section-title">
                    <h2>QUI SUIS-JE</h2>
                </div>

                <div class="section-content">
                    <div class="d-flex justify-content-center">
                        <img id="avatar" v-bind:src="'../../images/avatar1.png'" alt="developper"><br/>
                    </div>
                    <div id="avatar-description" class="text-center mt-2 mb-5">
                        <h5>David De Lima, 45 ans.</h5>
                        <em>Développeur web Backend.</em><br/>
                        <em>Freelance.</em><br/>
                    </div>
                    <div class="about-paragraphs">

                        <p>
                            D'abord technicien en électronique en bureau d'études, puis plusieurs années dans la logistique, j'opère un virage à 180 degrés il y
                            a deux ans pour renouer avec mes premières expériences en développement informatique. Openclassrooms, plateforme de cours en ligne
                            et leader Européen dans ce domaine m'a permis de relever ce défi. Devenir Chef de projet digital spécialisé dans le développement.
                        </p>
                        <p>
                            J'aime beaucoup voyager, et toutes les occasions sont bonnes pour découvrir de nouveaux horizons, de nouvelles cultures, de nouvelles
                            personnes. Je suis curieux de tout ce que je ne connais pas...Mais aussi, sportif aguérri. J'ai pratiqué les sports de combat et le culturisme à un haut niveau.
                        </p>
                        <p>
                            Autodidacte et passionné, j'attache une grande importance autant à la résolution de petites anomalies techniques qu'à la gestion de projets
                            d'envergure. J'aime apprendre et j'aime relever de nouveaux défis, tout particulièrement lorsqu'un projet me permet de sortir de ma zone de confort et d'acquérir de nouvelles
                            compétences. Je m'adapte à vos besoins et suis tout à fait capable d'intégrer votre équipe. Amoureux des nouvelles technologies, je pratique une veille quotidienne permanente
                            afin de vous proposer les dernières avancées technologiques pour vos projets innovants.
                        </p>

                    </div>

                </div>
            </div>
        </section>
        <!-- About section. -->

        <!-- Skills section. -->
        <section v-view="viewSkillsHandler" id="skills" class="section-content">
            <div class="container">
                <div class="section-title">
                    <h2>COMPÉTENCES</h2>
                </div>
                <div class="section-content">

                    <!-- Language skills -->
                    <div id="language" class="row">
                        <div class="col-sm-12 text-center">
                            <hr width="100px">
                            <h6>Languages utilisés</h6>
                        </div>
                    </div>
                    <language v-bind:skill="skill" ></language>
                    <!-- Language skills -->

                    <!-- Frameworks skills -->
                    <div id="frameworks" class="row">
                        <div class="col-sm-12 text-center">
                            <hr width="100px">
                            <h6>Frameworks</h6>
                        </div>
                    </div>
                    <framework  v-bind:skill="skill" ></framework>
                    <!-- Frameworks skills -->

                    <!-- Tools skills -->
                    <div id="tools" class="row">
                        <div class="col-sm-12 text-center">
                            <hr width="100px">
                            <h6>Outils</h6>
                        </div>
                    </div>
                    <tool v-bind:skill="skill"></tool>
                    <!-- Tools skills -->
                </div>
            </div>
        </section>
        <!-- Skills section. -->

        <!-- Developments  section. -->
        <section id="developments">
            <div class="container">
                <div class="section-title">
                    <h2>MES RÉALISATIONS</h2>
                </div>
                <div class="section-content">
                    <div class="row">

                        <!-- First development -->
                        <div class="col-md-4">
                            <!-- Card -->
                            <div class="card view overlay">

                                <!-- card image -->
                                <img class="card-img-top" v-bind:src="'../../images/digoin.png'" alt="digoin website" >
                                <a href="#">
                                    <div class="mask rgba-teal-strong d-flex align-items-center">
                                        <!-- Overlay content -->
                                        <div class="project-description">

                                            <ul>
                                                <li>RÉALISÉ A L'AIDE DU CMS WORDPRESS</li>
                                                <li>THÈME ENFANT PERSONNALISÉ</li>
                                                <li>GESTION D'ÉVÈNEMENTS</li>
                                                <li>SYSTÈME DE NEWS</li>
                                            </ul>

                                            <hr>

                                            <p>Projet réalisé dans le cadre de ma formation afin de promouvoir la ville de Digoin.</p>
                                        </div>
                                        <!-- Overlay content -->
                                    </div>
                                </a>
                                <!-- card image -->

                                <!-- Card content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="card-title">
                                        <h6><strong>Ville de Digoin</strong></h6>
                                    </div>
                                    <!-- Title -->
                                    <p class="card-text">

                                    </p>

                                </div>
                                <!-- Card content -->
                            </div>
                            <!-- Card -->

                        </div>
                        <!-- First development -->

                        <!-- Second development -->
                        <div class="col-md-4">
                            <!-- Card -->
                            <div class="card view overlay">

                                <!-- card image -->
                                <img class="card-img-top" v-bind:src="'../../images/plane.png'" alt="jean-forteroche website" >
                                <a href="#">
                                    <div class="mask rgba-teal-strong d-flex align-items-center">
                                        <!-- Overlay content -->
                                        <div class="project-description">

                                            <ul>
                                                <li>UTILISATION DU FRAMEWORK PHP "SILEX"</li>
                                                <li>BOOTSTRAP</li>
                                                <li>PHP, POO</li>
                                                <li>JAVASCRIPT, JQUERY</li>
                                                <li>MYSQL</li>
                                                <li>ARCHITECTURE MVC</li>
                                            </ul>

                                            <hr>

                                            <p>Projet de blog réalisé dans le cadre de ma formation. Gestion utilisateurs, articles et commentaires à l'aide d'un espace administrateur.</p>
                                        </div>
                                        <!-- Overlay content -->

                                    </div>
                                </a>
                                <!-- card image -->

                                <!-- Card content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="card-title">
                                        <h6><strong>Blog Jean Forteroche</strong></h6>
                                    </div>
                                    <p class="card-text">

                                    </p>
                                    <!-- Title -->
                                </div>
                                <!-- Card content -->
                            </div>
                            <!-- Card -->

                        </div>
                        <!-- Second development -->

                        <!-- Third development -->
                        <div class="col-md-4">
                            <!-- Card -->
                            <div class="card view overlay">

                                <!-- card image -->
                                <img class="card-img-top" v-bind:src="'../../images/billetterie.png'" alt="louvre booking website" >
                                <a href="https://github.com/buba71/OCLouvreBooking">
                                    <div class="mask rgba-teal-strong d-flex align-items-center">
                                        <!-- Overlay content -->
                                        <div class="project-description">

                                            <ul>
                                                <li>UTILISATION DE "SYMFONY 4"</li>
                                                <li>PHP, JAVASCRIPT(JQUERY)</li>
                                                <li>MYSQL.</li>
                                                <li>TEST UNITAIRES, ET FONCTIONNELS</li>
                                                <li>SYSTÈME DE PAIEMENT "STRIPE"</li>
                                            </ul>

                                            <hr>

                                            <p>Projet de billetterie en ligne dans le cadre de ma formation. Développement à l'aide de Symfony 4 afin d'appréhender ses principales fonctionnalités.
                                                Formulaires, validation, services, évènements, swiftmailer, tests. </p>
                                        </div>
                                        <!-- Overlay content -->
                                    </div>
                                </a>
                                <!-- card image -->

                                <!-- Card content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="card-title">
                                        <h6><strong>Billetterie</strong></h6>
                                    </div>
                                    <p class="card-text">

                                    </p>
                                    <!-- Title -->
                                </div>
                                <!-- Card content -->
                            </div>
                            <!-- Card -->

                        </div>
                        <!-- Third development -->

                        <!-- Fourth development -->
                        <div class="col-md-4">
                            <!-- Card -->
                            <div class="card view overlay">
                                <!-- card image -->

                                <img class="card-img-top" v-bind:src="'../../images/gallery.png'" alt="photographer website" >
                                <a href="https://github.com/buba71/photographer_symfony">
                                    <div class="mask rgba-teal-strong d-flex align-items-center">
                                        <!-- Overlay content -->
                                        <div class="project-description">

                                            <ul>
                                                <li>SYMFONY 4</li>
                                                <li>PHP, JAVASCRIPT, AJAX</li>
                                                <li>MYSQL</li>
                                                <li>DOCKER</li>
                                                <li>TRAVIS CI</li>
                                            </ul>

                                            <hr>

                                            <p>Galerie photo réalisée pour un photographe professionnel.
                                                Utilisation avancée de Symfony 4.
                                            </p>
                                        </div>
                                        <!-- Overlay content -->
                                    </div>
                                </a>
                                <!-- card image -->

                                <!-- Card content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="card-title">
                                        <h6><strong>Galerie photo</strong></h6>
                                    </div>
                                    <p class="card-text">

                                    </p>
                                    <!-- Title -->
                                </div>
                                <!-- Card content -->
                            </div>
                            <!-- Card -->

                        </div>
                        <!-- Fourth development -->

                        <!-- Fifh development -->
                        <div class="col-md-4">
                            <!-- Card -->
                            <div class="card view overlay">
                                <!-- card image -->

                                <img class="card-img-top" v-bind:src="'../../images/portfolio.png'" alt="portfolio website" >
                                <a href="https://github.com/buba71/portfolio/tree/master">
                                    <div class="mask rgba-teal-strong d-flex align-items-center">
                                        <!-- Overlay content -->
                                        <div class="project-description">

                                            <ul>
                                                <li>SYMFONY 4, VUE.JS, API PLATFORM</li>
                                                <li>PHP, JAVASCRIPT, AJAX</li>
                                                <li>MYSQL</li>
                                                <li>DOCKER</li>
                                                <li>TRAVIS CI</li>
                                            </ul>

                                            <hr>

                                            <p>Site web utilisant vue.js pour le frontend couplé à symfony 4 pour le backend grâce à une API(API Platform).</p>
                                        </div>
                                        <!-- Overlay content -->
                                    </div>
                                </a>
                                <!-- card image -->

                                <!-- Card content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="card-title">
                                        <h6><strong>Portfolio</strong></h6>
                                    </div>
                                    <p class="card-text">

                                    </p>
                                    <!-- Title -->
                                </div>
                                <!-- Card content -->
                            </div>
                            <!-- Card -->

                        </div>
                        <!-- Fifth development -->

                        <!-- sixfth development -->
                        <div class="col-md-4">
                            <!-- Card -->
                            <div class="card view overlay">
                                <!-- card image -->

                                <img class="card-img-top" v-bind:src="'../../images/breengrow.png'" alt="Breengrow website" >
                                <a href="https://github.com/buba71/breengrow-frontend">
                                    <div class="mask rgba-teal-strong d-flex align-items-center">
                                        <!-- Overlay content -->
                                        <div class="project-description">

                                            <ul>
                                                <li>SYMFONY 4, NUXT.JS, API PLATFORM</li>
                                                <li>PHP, JAVASCRIPT</li>
                                                <li>MYSQL</li>
                                                <li>DOCKER</li>
                                                <li>TRAVIS CI</li>
                                            </ul>

                                            <hr>

                                            <p>Plateforme web d'échange utilisant nuxt.js pour le frontend et une api symfony 4 pour le backend(API Platform).</p>
                                        </div>
                                        <!-- Overlay content -->
                                    </div>
                                </a>
                                <!-- card image -->

                                <!-- Card content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="card-title">
                                        <h6><strong>Breengrow</strong></h6>
                                    </div>
                                    <p class="card-text">

                                    </p>
                                    <!-- Title -->
                                </div>
                                <!-- Card content -->
                            </div>
                            <!-- Card -->

                        </div>
                        <!-- Fifth development -->
                    </div>
                </div>
            </div>



        </section>
        <!-- Developments section. -->

        <!-- Contact section. -->
        <section id="contact">
            <div class="container">
                <div class="section-title">
                    <h2>ME CONTACTER</h2>
                </div>
                <div class="section-content">
                    <span>Un renseignement, un projet à proposer ? Contactez-moi en utilisant le formulaire ci-dessous.</span>
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Contact component -->
                            <contact-form></contact-form>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center mt-5">
                            <address>
                                <ul class="list-unstyled mt-3 ml-5">
                                    <li>
                                        <p><i class="fas fa-map-marker-alt pr-2"></i> Bourgogne, France</p>
                                    </li>
                                    <li>
                                        <p><i class="fas fa-phone pr-2"></i> 06-62-25-52-76</p>
                                    </li>
                                    <li>
                                        <p><i class="fas fa-envelope"></i> contact@david-de-lima.tech</p>
                                    </li>
                                </ul>
                            </address>
                        </div>
                    </div>


                </div>

            </div>

        </section>
        <!-- Contact section. -->

    </div>



</template>
<script type="text/javascript">

import language from '../../components/skills/language';
import framework from '../../components/skills/framework';
import tool from '../../components/skills/tool';
import scrollButton from '../../components/navigation/scrollButton';
import ContactForm from '../../components/contact/contactForm';



export default {
    name: 'homeIndex',
    components: { language, framework, tool, scrollButton, ContactForm },
    data: function () {
        return {
            service: false,
            skill: false,
        }
    },
    methods: {
        viewServiceHandler(e) {
            if (e.type === 'enter') {
                this.service = true;
            }
        },
        viewSkillsHandler(e) {
            if (e.type === 'enter') {
                this.skill = true;
            }
        },
    },


}
</script>