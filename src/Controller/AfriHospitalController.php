<?php

namespace App\\Controller;

use Symfony\\Component\\HttpFoundation\\Response;
use Symfony\\Component\\Routing\\Attribute\\Route;

final class AfriHospitalController
{
    #[Route('/afrihospital', name: 'afrihospital', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response(<<<'HTML'
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Découvrez AfriHospital, une application de gestion hospitalière pensée pour organiser les activités et les services d'un établissement de santé.">
  <meta name="theme-color" content="#171714">
  <title>AfriHospital — Hianpe</title>
  <link rel="icon" type="image/png" href="/assets/logo_hianpe.png">
  <style>
    :root{--ink:#171714;--paper:#f5f0e6;--yellow:#f5c542;--muted:#6f6b62;--line:rgba(23,23,20,.14);--white:#fffdf8;--max:1160px}
    *{box-sizing:border-box}html{scroll-behavior:smooth;scroll-padding-top:90px}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;line-height:1.6}a{color:inherit;text-decoration:none}.wrap{width:min(var(--max),calc(100% - 40px));margin:auto}
    .topbar{position:sticky;top:0;z-index:20;background:rgba(245,240,230,.94);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}.nav{height:82px;display:flex;align-items:center;justify-content:space-between;gap:24px}.brand{display:flex;align-items:center;gap:12px;font-weight:850;letter-spacing:-.04em;font-size:1.35rem}.brand img{width:46px;height:46px;object-fit:contain;border-radius:12px}.navlinks{display:flex;align-items:center;gap:24px;font-size:.92rem;font-weight:700}.navlinks a:not(.button):hover{opacity:.65}.language-toggle,.menu-toggle{border:1px solid var(--line);background:transparent;color:var(--ink);border-radius:999px;padding:9px 13px;font:inherit;font-size:.82rem;font-weight:850;cursor:pointer}.menu-toggle{display:none;border-radius:12px;font-size:1.15rem}.button{display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:13px 19px;border:1px solid var(--ink);border-radius:999px;background:var(--ink);color:var(--white);font-size:.92rem;font-weight:800;transition:transform .2s}.button:hover{transform:translateY(-2px)}.button.yellow{background:var(--yellow);border-color:var(--yellow);color:var(--ink)}.button.outline{background:transparent;color:var(--ink)}
    .hero{padding:84px 0 75px;overflow:hidden}.hero-grid{display:grid;grid-template-columns:1.05fr .95fr;align-items:center;gap:54px}.eyebrow{display:inline-flex;align-items:center;gap:9px;color:#705b1b;text-transform:uppercase;letter-spacing:.14em;font-size:.74rem;font-weight:900}.eyebrow:before{content:"";width:25px;height:2px;background:var(--yellow)}h1,h2,h3,p{margin-top:0}h1{font-size:clamp(3.1rem,6.5vw,5.8rem);line-height:.96;letter-spacing:-.08em;margin:22px 0}.highlight{background:var(--yellow);padding:0 .12em;box-decoration-break:clone;-webkit-box-decoration-break:clone}.lead{font-size:1.12rem;max-width:590px;color:#57554e;margin-bottom:28px}.actions{display:flex;flex-wrap:wrap;gap:12px}.trust{display:flex;align-items:center;gap:10px;margin-top:24px;color:var(--muted);font-size:.85rem}.dot{width:9px;height:9px;background:#4f8054;border-radius:50%;box-shadow:0 0 0 5px #4f80541e}
    .hero-art{position:relative;min-height:410px;display:grid;place-items:center}.hero-art:before{content:"";position:absolute;width:min(90%,390px);aspect-ratio:1;background:var(--yellow);border-radius:50%;right:0;top:5px}.dashboard{position:relative;width:min(100%,470px);padding:24px;border-radius:23px;background:#20201c;color:var(--white);box-shadow:0 30px 75px #17171435;transform:rotate(1.2deg)}.dash-head{display:flex;align-items:center;justify-content:space-between;gap:10px;border-bottom:1px solid #424239;padding-bottom:17px}.dash-title{font-weight:850;font-size:1.1rem}.dash-status{font-size:.7rem;border-radius:999px;background:#254c36;color:#c5f0ce;padding:6px 10px}.dash-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:18px}.dash-card{background:#30302a;border:1px solid #45453c;border-radius:14px;padding:15px}.dash-card span{display:block;font-size:.78rem;color:#b8b5aa}.dash-card strong{display:block;font-size:1.55rem;color:var(--yellow);margin-top:6px}.dash-bottom{margin-top:14px;border-radius:14px;padding:16px;background:#30302a}.dash-line{height:8px;background:#525248;border-radius:20px;margin:10px 0}.dash-line:nth-child(2){width:82%}.dash-line:nth-child(3){width:57%}.float{position:absolute;z-index:2;padding:12px 15px;background:var(--white);border:1px solid var(--line);border-radius:14px;box-shadow:0 14px 35px #17171415;font-weight:850;font-size:.88rem}.float.one{top:10px;left:-3px}.float.two{right:-5px;bottom:10px}
    .section{padding:80px 0}.dark{background:var(--ink);color:var(--white)}.section-head{display:flex;justify-content:space-between;align-items:end;gap:30px;margin-bottom:34px}.section-head h2{font-size:clamp(2.2rem,4.4vw,3.65rem);line-height:1.02;letter-spacing:-.07em;max-width:660px;margin:13px 0 0}.section-head p{max-width:420px;color:var(--muted);margin:0}.dark .section-head p{color:#b8b5aa}.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:15px}.feature{border:1px solid var(--line);border-radius:20px;background:#fffdf87a;padding:25px;min-height:210px}.feature-icon{width:46px;height:46px;display:grid;place-items:center;border-radius:14px;background:var(--yellow);font-size:1.25rem;margin-bottom:21px}.feature h3{font-size:1.1rem;margin-bottom:8px;letter-spacing:-.03em}.feature p{color:var(--muted);font-size:.93rem;margin:0}
    .video-section{padding:76px 0;background:var(--white)}.video-frame{width:100%;max-width:1000px;margin:0 auto;aspect-ratio:16/9;overflow:hidden;border-radius:22px;background:#171714;box-shadow:0 22px 60px #17171420}.video-frame iframe{display:block;width:100%;height:100%;border:0}.intro{max-width:700px;color:var(--muted);margin:0 0 27px}.gallery{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.shot{display:block;overflow:hidden;border-radius:19px;background:#2c2c27;border:1px solid #44443c;box-shadow:0 14px 35px #00000020}.shot img{display:block;width:100%;height:auto;min-height:190px;object-fit:cover;transition:transform .35s}.shot:hover img{transform:scale(1.025)}.shot-label{padding:12px 16px;color:#fffdf8;background:#252520;font-size:.82rem;font-weight:800}.note{font-size:.85rem;color:#b8b5aa;margin:18px 0 0}.steps{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}.step{border-top:2px solid #41413a;padding-top:19px}.num{color:var(--yellow);font-size:.76rem;font-weight:900;letter-spacing:.14em}.step h3{margin:13px 0 7px}.step p{color:#b8b5aa;font-size:.9rem}.cta{background:var(--yellow);border-radius:26px;padding:clamp(28px,5vw,55px);display:flex;align-items:center;justify-content:space-between;gap:25px}.cta h2{font-size:clamp(2.1rem,4.5vw,3.5rem);line-height:1;letter-spacing:-.07em;max-width:700px;margin:14px 0}.cta p{color:#51451f;max-width:600px;margin:0}.footer{padding:27px 0;background:var(--ink);color:#b8b5aa;font-size:.83rem}.footer-inner{display:flex;justify-content:space-between;gap:20px;align-items:center}.footer-brand{color:var(--white);font-weight:900}.footer a:hover{color:var(--yellow)}
    @media(max-width:850px){.hero-grid{grid-template-columns:1fr;gap:20px}.hero{padding-top:58px}.hero-art{min-height:380px}.feature-grid{grid-template-columns:repeat(2,1fr)}.section-head{align-items:start;flex-direction:column}.steps{grid-template-columns:1fr 1fr}.cta{align-items:flex-start;flex-direction:column}}
    @media(max-width:620px){.wrap{width:calc(100% - 28px)}.nav{height:72px;position:relative}.brand img{width:40px;height:40px}.menu-toggle{display:block}.navlinks{display:none;position:absolute;top:72px;left:0;right:0;z-index:30;background:var(--paper);padding:18px 22px 24px;border-bottom:1px solid var(--line);flex-direction:column;align-items:stretch;gap:18px}.navlinks.open{display:flex}.navlinks .button{align-self:flex-start}.hero{padding:48px 0 35px}h1{font-size:clamp(3rem,14vw,4.5rem)}.lead{font-size:1rem}.hero-art{min-height:330px}.dashboard{padding:17px}.float{font-size:.76rem;padding:9px 11px}.section{padding:60px 0}.feature-grid,.gallery,.steps{grid-template-columns:1fr}.feature{min-height:0}.gallery{gap:13px}.footer-inner{align-items:flex-start;flex-direction:column}}
    @media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}*,*:before,*:after{transition:none!important}}
  </style>
</head>
<body>
<header class="topbar"><div class="wrap nav">
  <a class="brand" href="/" aria-label="Hianpe, accueil"><img src="/assets/logo_hianpe.png" alt="Logo Hianpe">Hianpe</a>
  <button class="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-expanded="false">☰</button>
  <nav class="navlinks" aria-label="Navigation principale">
    <a href="/#services" data-i18n="Services">Services</a><a href="/#logiciels" data-i18n="Logiciels">Logiciels</a><a href="/#approche" data-i18n="Notre approche">Notre approche</a><button class="language-toggle" type="button" aria-label="Switch to English" title="Switch to English">EN</button><a class="button" href="/contact" data-i18n="Parlons de votre projet">Parlons de votre projet ↗</a>
  </nav>
</div></header>
<main>
<section class="hero"><div class="wrap hero-grid">
  <div>
    <div class="eyebrow" data-i18n="Gestion hospitalière">Gestion hospitalière</div>
    <h1>Une gestion plus claire.<br><span class="highlight">AfriHospital.</span></h1>
    <p class="lead" data-i18n="hero-copy">Découvrez AfriHospital, une application de gestion hospitalière conçue pour aider les établissements de santé à organiser leurs informations et leurs activités dans un espace de travail centralisé.</p>
    <div class="actions"><a class="button yellow" href="/Installer/AfriHospital-Setup-1.0.0.exe" data-i18n="Télécharger pour Windows ↓">Télécharger pour Windows ↓</a><a class="button outline" href="#captures" data-i18n="Voir les captures">Voir les captures ↓</a></div>
    <div class="trust"><span class="dot"></span><span data-i18n="Application de bureau · Présentation et téléchargement">Application de bureau · Présentation et téléchargement</span></div>
  </div>
  <div class="hero-art" aria-label="Aperçu illustratif du tableau de bord AfriHospital">
    <span class="float one" data-i18n="Vue d’ensemble">Vue d’ensemble</span>
    <div class="dashboard"><div class="dash-head"><span class="dash-title">AfriHospital</span><span class="dash-status" data-i18n="Tableau de bord">Tableau de bord</span></div>
      <div class="dash-grid"><div class="dash-card"><span data-i18n="Patients">Patients</span><strong>+ Patients</strong></div><div class="dash-card"><span data-i18n="Rendez-vous">Rendez-vous</span><strong>Agenda</strong></div><div class="dash-card"><span data-i18n="Personnel">Personnel</span><strong>Équipe</strong></div><div class="dash-card"><span data-i18n="Services">Services</span><strong>+</strong></div></div>
      <div class="dash-bottom"><span class="dash-title" data-i18n="Activité de l’établissement">Activité de l’établissement</span><div class="dash-line"></div><div class="dash-line"></div><div class="dash-line"></div></div>
    </div>
    <span class="float two" data-i18n="Les informations au même endroit">Les informations au même endroit ✓</span>
  </div>
</div></section>
<section class="section" id="fonctionnalites"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow" data-i18n="Fonctionnalités">Fonctionnalités</div><h2 data-i18n="Les principaux outils pour organiser les activités hospitalières.">Les principaux outils pour organiser les activités hospitalières.</h2></div><p data-i18n="features-intro">Une application de bureau qui rassemble plusieurs domaines de gestion pour faciliter le suivi quotidien d’un établissement de santé.</p></div>
  <div class="feature-grid">
    <article class="feature"><div class="feature-icon">♡</div><h3 data-i18n="Dossiers des patients">Dossiers des patients</h3><p data-i18n="patients-copy">Centralisez les informations essentielles et retrouvez les dossiers plus facilement.</p></article>
    <article class="feature"><div class="feature-icon">▦</div><h3 data-i18n="Admissions et rendez-vous">Admissions et rendez-vous</h3><p data-i18n="appointments-copy">Organisez les admissions et planifiez les rendez-vous au sein de l’établissement.</p></article>
    <article class="feature"><div class="feature-icon">♙</div><h3 data-i18n="Personnel et utilisateurs">Personnel et utilisateurs</h3><p data-i18n="staff-copy">Gérez les informations de l’équipe et les accès des utilisateurs selon les fonctions prévues dans l’application.</p></article>
    <article class="feature"><div class="feature-icon">▤</div><h3 data-i18n="Lits et hospitalisation">Lits et hospitalisation</h3><p data-i18n="beds-copy">Suivez les lits et les informations liées à l’occupation des espaces d’hospitalisation.</p></article>
    <article class="feature"><div class="feature-icon">✚</div><h3 data-i18n="Pharmacie et laboratoire">Pharmacie et laboratoire</h3><p data-i18n="pharmacy-copy">Regroupez les informations de pharmacie et de laboratoire dans les modules dédiés.</p></article>
    <article class="feature"><div class="feature-icon">▣</div><h3 data-i18n="Facturation et tableau de bord">Facturation et tableau de bord</h3><p data-i18n="billing-copy">Accédez aux fonctions de facturation et à une vue d’ensemble de l’activité.</p></article>
  </div>
</div></section>
<section class="video-section" id="video"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow" data-i18n="Présentation vidéo">Présentation vidéo</div><h2 data-i18n="Découvrez AfriHospital en action.">Découvrez AfriHospital en action.</h2></div></div>
  <p class="intro" data-i18n="video-copy">Lancez la vidéo pour découvrir l’application et son interface.</p>
  <div class="video-frame"><iframe src="https://www.youtube-nocookie.com/embed/gl_YjI0LNsU" title="Présentation vidéo d’AfriHospital" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
</div></section>
<section class="section dark" id="captures"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow" data-i18n="Galerie">Galerie</div><h2 data-i18n="Un aperçu de l’interface.">Un aperçu de l’interface.</h2></div><p data-i18n="gallery-copy">Découvrez quelques écrans d’AfriHospital. Sélectionnez une image pour l’ouvrir en grand.</p></div>
  <div class="gallery">
    <a class="shot" href="/assets/Sreenshots/image_quatre.PNG" target="_blank" rel="noreferrer"><img src="/assets/Sreenshots/image_quatre.PNG" alt="Capture d’écran AfriHospital 1" loading="lazy"><div class="shot-label" data-i18n="Aperçu de l’application — 01">Aperçu de l’application — 01</div></a>
    <a class="shot" href="/assets/Sreenshots/image_cinq.PNG" target="_blank" rel="noreferrer"><img src="/assets/Sreenshots/image_cinq.PNG" alt="Capture d’écran AfriHospital 2" loading="lazy"><div class="shot-label" data-i18n="Aperçu de l’application — 02">Aperçu de l’application — 02</div></a>
    <a class="shot" href="/assets/Sreenshots/image_six.PNG" target="_blank" rel="noreferrer"><img src="/assets/Sreenshots/image_six.PNG" alt="Capture d’écran AfriHospital 3" loading="lazy"><div class="shot-label" data-i18n="Aperçu de l’application — 03">Aperçu de l’application — 03</div></a>
    <a class="shot" href="/assets/Sreenshots/image_sept.PNG" target="_blank" rel="noreferrer"><img src="/assets/Sreenshots/image_sept.PNG" alt="Capture d’écran AfriHospital 4" loading="lazy"><div class="shot-label" data-i18n="Aperçu de l’application — 04">Aperçu de l’application — 04</div></a>
    <a class="shot" href="/assets/Sreenshots/image_huit.PNG" target="_blank" rel="noreferrer"><img src="/assets/Sreenshots/image_huit.PNG" alt="Capture d’écran AfriHospital 5" loading="lazy"><div class="shot-label" data-i18n="Aperçu de l’application — 05">Aperçu de l’application — 05</div></a>
  </div>
  <p class="note" data-i18n="gallery-note">Les captures doivent être présentes dans le dossier public/assets/Sreenshots du site pour apparaître en ligne.</p>
</div></section>
<section class="section"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow" data-i18n="Pour commencer">Pour commencer</div><h2 data-i18n="Installez et explorez l’application.">Installez et explorez l’application.</h2></div></div>
  <div class="steps">
    <article class="step"><span class="num">ÉTAPE 01</span><h3 data-i18n="Télécharger">Télécharger</h3><p data-i18n="download-copy">Téléchargez le programme d’installation d’AfriHospital pour Windows.</p></article>
    <article class="step"><span class="num">ÉTAPE 02</span><h3 data-i18n="Installer">Installer</h3><p data-i18n="install-copy">Ouvrez le fichier téléchargé et suivez les instructions d’installation affichées.</p></article>
    <article class="step"><span class="num">ÉTAPE 03</span><h3 data-i18n="Découvrir">Découvrir</h3><p data-i18n="discover-copy">Lancez l’application et explorez ses différents modules.</p></article>
  </div>
</div></section>
<section class="section" id="contact"><div class="wrap"><div class="cta"><div><div class="eyebrow" data-i18n="AfriHospital par Hianpe">AfriHospital par Hianpe</div><h2 data-i18n="Découvrez une nouvelle façon d’organiser vos opérations.">Découvrez une nouvelle façon d’organiser vos opérations.</h2><p data-i18n="cta-copy">Vous avez une question ou un retour à partager au sujet d’AfriHospital ? Contactez Hianpe.</p></div><a class="button" href="/contact" data-i18n="Contacter Hianpe ↗">Contacter Hianpe ↗</a></div></div></section>
</main>
<footer class="footer"><div class="wrap footer-inner"><a class="footer-brand" href="/">Hianpe</a><span>© <span id="year">2026</span> Hianpe. <span data-i18n="Des solutions numériques pensées pour durer.">Des solutions numériques pensées pour durer.</span></span><div><a href="/#logiciels" data-i18n="Tous les logiciels">Tous les logiciels</a> · <a href="/contact" data-i18n="Contact">Contact</a></div></div></footer>
<script>
document.getElementById('year').textContent = new Date().getFullYear();
const menuToggle=document.querySelector('.menu-toggle'), menu=document.querySelector('.navlinks');
menuToggle.addEventListener('click',()=>{const open=menu.classList.toggle('open');menuToggle.setAttribute('aria-expanded',String(open));menuToggle.setAttribute('aria-label',open?'Fermer le menu':'Ouvrir le menu');menuToggle.textContent=open?'×':'☰';});
const translations={
"Services":"Services","Logiciels":"Software","Notre approche":"Our approach","Parlons de votre projet":"Let's discuss your project",
"Gestion hospitalière":"Hospital management","hero-copy":"Discover AfriHospital, a hospital management application designed to help healthcare facilities organize information and activities in one centralized workspace.",
"Télécharger pour Windows ↓":"Download for Windows ↓","Voir les captures":"View screenshots","Application de bureau · Présentation et téléchargement":"Desktop application · Overview and download","Vue d’ensemble":"Overview","Tableau de bord":"Dashboard","Patients":"Patients","Rendez-vous":"Appointments","Personnel":"Staff","Activité de l’établissement":"Facility activity","Les informations au même endroit":"Information in one place ✓",
"Fonctionnalités":"Features","Les principaux outils pour organiser les activités hospitalières.":"Key tools to organize hospital operations.","features-intro":"A desktop application that brings together several management areas to support the day-to-day work of a healthcare facility.",
"Dossiers des patients":"Patient records","patients-copy":"Centralize essential information and find patient records more easily.","Admissions et rendez-vous":"Admissions and appointments","appointments-copy":"Organize admissions and schedule appointments within the facility.","Personnel et utilisateurs":"Staff and users","staff-copy":"Manage team information and user access according to the functions available in the application.","Lits et hospitalisation":"Beds and inpatient care","beds-copy":"Track beds and information related to inpatient capacity.","Pharmacie et laboratoire":"Pharmacy and laboratory","pharmacy-copy":"Bring pharmacy and laboratory information together in dedicated modules.","Facturation et tableau de bord":"Billing and dashboard","billing-copy":"Access billing functions and an overview of activity.",
"Présentation vidéo":"Video overview","Découvrez AfriHospital en action.":"See AfriHospital in action.","video-copy":"Play the video to explore the application and its interface.","Galerie":"Gallery","Un aperçu de l’interface.":"A look at the interface.","gallery-copy":"Explore a few AfriHospital screens. Select an image to open it in full size.",
"Aperçu de l’application — 01":"Application preview — 01","Aperçu de l’application — 02":"Application preview — 02","Aperçu de l’application — 03":"Application preview — 03","Aperçu de l’application — 04":"Application preview — 04","Aperçu de l’application — 05":"Application preview — 05",
"gallery-note":"The screenshots must be present in the site's public/assets/Sreenshots folder to appear online.","Pour commencer":"Getting started","Installez et explorez l’application.":"Install and explore the application.","Télécharger":"Download","download-copy":"Download the AfriHospital installer for Windows.","Installer":"Install","install-copy":"Open the downloaded file and follow the installation instructions displayed.","Découvrir":"Explore","discover-copy":"Launch the application and explore its different modules.",
"AfriHospital par Hianpe":"AfriHospital by Hianpe","Découvrez une nouvelle façon d’organiser vos opérations.":"Discover a new way to organize your operations.","cta-copy":"Have a question or feedback about AfriHospital? Contact Hianpe.","Contacter Hianpe ↗":"Contact Hianpe ↗","Des solutions numériques pensées pour durer.":"Digital solutions built to last.","Tous les logiciels":"All software","Contact":"Contact"
};
const original=new Map();
document.querySelectorAll('[data-i18n]').forEach(el=>original.set(el,el.textContent));
function setLanguage(lang){
 document.documentElement.lang=lang;
 document.querySelectorAll('.language-toggle').forEach(btn=>{btn.textContent=lang==='fr'?'EN':'FR';btn.title=lang==='fr'?'Switch to English':'Passer en français';btn.setAttribute('aria-label',btn.title);});
 document.querySelectorAll('[data-i18n]').forEach(el=>{const fr=original.get(el);el.textContent=lang==='en'?(translations[fr]||fr):fr;});
 document.title=lang==='fr'?'AfriHospital — Hianpe':'AfriHospital — Hianpe';
 try{localStorage.setItem('hianpe-language',lang);}catch(e){}
}
document.querySelectorAll('.language-toggle').forEach(btn=>btn.addEventListener('click',()=>setLanguage(document.documentElement.lang==='en'?'fr':'en')));
let lang='fr';try{lang=localStorage.getItem('hianpe-language')||'fr';}catch(e){}setLanguage(lang==='en'?'en':'fr');
</script>
</body>
</html>
HTML
        , Response::HTTP_OK, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}
