<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StageFlowController
{
    #[Route('/stageflow', name: 'stageflow', methods: ['GET'])]
    public function __invoke(): Response
    {
        $projectDir = dirname(__DIR__, 2);
        $screenshotsDir = $projectDir . '/public/assets/Sreenshots';
        $files = [];

        if (is_dir($screenshotsDir)) {
            foreach (['*.png', '*.PNG', '*.jpg', '*.JPG', '*.jpeg', '*.JPEG', '*.webp', '*.WEBP', '*.gif', '*.GIF'] as $pattern) {
                foreach (glob($screenshotsDir . '/' . $pattern) ?: [] as $file) {
                    if (is_file($file)) {
                        $files[] = basename($file);
                    }
                }
            }
        }

        natcasesort($files);
        $gallery = '';
        foreach ($files as $index => $file) {
            $safeName = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
            $src = '/assets/Sreenshots/' . rawurlencode($file);
            $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
            $gallery .= '<a class="shot" href="' . htmlspecialchars($src, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noreferrer" aria-label="Ouvrir la capture ' . $number . '">'
                . '<img src="' . htmlspecialchars($src, ENT_QUOTES, 'UTF-8') . '" alt="Capture d’écran de StageFlow — ' . $safeName . '" loading="lazy">'
                . '<span class="shot-number">CAPTURE ' . $number . '</span></a>';
        }

        if ($gallery === '') {
            $gallery = '<div class="gallery-empty"><strong>Les captures d’écran arrivent ici.</strong><p>Ajoutez les images dans <code>public/assets/Sreenshots/</code>, puis envoyez ce dossier sur GitHub. La galerie les affichera automatiquement.</p></div>';
        }

        $count = count($files);
        $galleryLabel = $count . ' capture' . ($count > 1 ? 's' : '') . ' de l’application';

        return new Response(<<<HTML
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Découvrez StageFlow, un logiciel de présentation pour les églises et les équipes : diapositives, paroles, Bible et médias dans un flux de travail simple.">
  <meta name="theme-color" content="#171714">
  <title>StageFlow — Présentation | Hianpe</title>
  <link rel="icon" type="image/png" href="/assets/logo_hianpe.png">
  <style>
    :root{--ink:#171714;--paper:#f5f0e6;--cream:#e8dcc5;--yellow:#f5c542;--muted:#6f6b62;--line:rgba(23,23,20,.14);--white:#fffdf8;--max:1160px}
    *{box-sizing:border-box}html{scroll-behavior:smooth;scroll-padding-top:88px}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;line-height:1.6}a{color:inherit;text-decoration:none}.wrap{width:min(var(--max),calc(100% - 40px));margin:auto}
    .topbar{position:sticky;top:0;z-index:10;background:rgba(245,240,230,.92);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}.nav{height:76px;display:flex;align-items:center;justify-content:space-between;gap:20px}.brand{display:flex;align-items:center;gap:11px;font-size:1.25rem;font-weight:900;letter-spacing:-.04em}.brand img{width:42px;height:42px;object-fit:contain;border-radius:10px}.navlinks{display:flex;align-items:center;gap:24px;font-weight:700;font-size:.9rem}.navlinks>a:not(.button):hover{opacity:.65}
    .button{display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:13px 19px;border:1px solid var(--ink);border-radius:999px;background:var(--ink);color:var(--white);font-size:.92rem;font-weight:800;transition:transform .2s}.button:hover{transform:translateY(-2px)}.button.yellow{background:var(--yellow);border-color:var(--yellow);color:var(--ink)}.button.outline{background:transparent;color:var(--ink)}
    .hero{padding:86px 0 76px;overflow:hidden}.hero-grid{display:grid;grid-template-columns:1.05fr .95fr;align-items:center;gap:55px}.eyebrow{display:inline-flex;align-items:center;gap:9px;color:#705b1b;text-transform:uppercase;letter-spacing:.14em;font-size:.73rem;font-weight:900}.eyebrow:before{content:"";width:25px;height:2px;background:var(--yellow)}h1,h2,h3,p{margin-top:0}h1{font-size:clamp(3.2rem,6.7vw,6rem);line-height:.94;letter-spacing:-.08em;margin:22px 0}.highlight{background:var(--yellow);padding:0 .12em;box-decoration-break:clone;-webkit-box-decoration-break:clone}.lead{font-size:1.13rem;max-width:580px;color:#57554e;margin-bottom:28px}.actions{display:flex;flex-wrap:wrap;gap:12px}.trust{display:flex;align-items:center;gap:10px;margin-top:25px;color:var(--muted);font-size:.85rem}.dot{width:9px;height:9px;background:#4f8054;border-radius:50%;box-shadow:0 0 0 5px #4f80541e}
    .hero-art{position:relative;min-height:420px;display:grid;place-items:center}.hero-art:before{content:"";position:absolute;width:min(90%,390px);aspect-ratio:1;background:var(--yellow);border-radius:50%;right:0;top:10px}.mock-window{position:relative;width:min(100%,460px);border:1px solid #44443c;border-radius:22px;overflow:hidden;background:#20201c;color:#fffdf8;box-shadow:0 32px 80px #17171430;transform:rotate(1.5deg)}.mock-bar{height:42px;background:#30302a;display:flex;align-items:center;gap:6px;padding:0 15px}.mock-bar i{width:8px;height:8px;border-radius:50%;background:#77766c}.mock-bar i:first-child{background:var(--yellow)}.mock-screen{padding:24px}.mock-label{font: .74rem ui-monospace,monospace;color:#aaa89e}.mock-slide{min-height:210px;margin-top:15px;padding:26px;border-radius:13px;background:linear-gradient(135deg,#35352e,#171714);display:flex;flex-direction:column;justify-content:center}.mock-slide small{color:var(--yellow);font-weight:800;letter-spacing:.14em}.mock-slide strong{font-size:clamp(1.5rem,3vw,2.4rem);line-height:1.05;letter-spacing:-.06em;margin-top:12px}.mock-controls{display:flex;gap:8px;margin-top:15px}.mock-controls span{height:7px;border-radius:9px;background:#505047;flex:1}.mock-controls span:first-child{background:var(--yellow)}.float{position:absolute;z-index:2;padding:12px 16px;background:var(--white);border:1px solid var(--line);border-radius:14px;box-shadow:0 14px 35px #17171415;font-weight:850}.float.one{top:22px;left:-3px}.float.two{right:-4px;bottom:18px}
    .section{padding:82px 0}.dark{background:var(--ink);color:var(--white)}.section-head{display:flex;justify-content:space-between;align-items:end;gap:30px;margin-bottom:36px}.section-head h2{font-size:clamp(2.2rem,4.5vw,3.7rem);line-height:1;letter-spacing:-.07em;max-width:650px;margin:13px 0 0}.section-head p{max-width:410px;color:var(--muted);margin:0}.dark .section-head p{color:#b8b5aa}.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:15px}.feature{border:1px solid var(--line);border-radius:20px;background:#fffdf87a;padding:25px;min-height:215px}.feature-icon{width:46px;height:46px;display:grid;place-items:center;border-radius:14px;background:var(--yellow);font-size:1.25rem;margin-bottom:22px}.feature h3{font-size:1.12rem;margin-bottom:8px;letter-spacing:-.03em}.feature p{color:var(--muted);font-size:.93rem;margin:0}
    .gallery{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.shot{position:relative;display:block;overflow:hidden;border-radius:19px;background:#2c2c27;border:1px solid #44443c;min-height:180px;box-shadow:0 14px 35px #00000020}.shot img{display:block;width:100%;height:auto;min-height:180px;object-fit:cover;transition:transform .35s}.shot:hover img{transform:scale(1.025)}.shot-number{position:absolute;left:15px;bottom:15px;background:#171714df;color:#fffdf8;padding:7px 11px;border-radius:999px;font-size:.68rem;letter-spacing:.12em;font-weight:900}.gallery-empty{grid-column:1/-1;padding:36px;border:1px dashed #66665a;border-radius:18px;color:#e9e5d9}.gallery-empty p{margin:8px 0 0;color:#bdb9ac}.gallery-empty code{color:var(--yellow);overflow-wrap:anywhere}.gallery-caption{font-size:.85rem;color:#b8b5aa;margin:20px 0 0}
    .workflow{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}.workflow article{border-top:2px solid #41413a;padding-top:19px}.num{color:var(--yellow);font-size:.76rem;font-weight:900;letter-spacing:.14em}.workflow h3{margin:13px 0 7px}.workflow p{color:#b8b5aa;font-size:.9rem}.cta{background:var(--yellow);border-radius:26px;padding:clamp(28px,5vw,55px);display:flex;align-items:center;justify-content:space-between;gap:25px}.cta h2{font-size:clamp(2.2rem,4.5vw,3.6rem);line-height:1;letter-spacing:-.07em;max-width:700px;margin:14px 0}.cta p{color:#51451f;max-width:600px;margin:0}.footer{padding:27px 0;background:var(--ink);color:#b8b5aa;font-size:.83rem}.footer-inner{display:flex;justify-content:space-between;gap:20px;align-items:center}.footer a:hover{color:var(--yellow)}.footer-brand{color:var(--white);font-weight:900}
    @media(max-width:850px){.hero-grid{grid-template-columns:1fr;gap:20px}.hero{padding-top:60px}.hero-art{min-height:380px}.hero-art:before{right:12%;width:320px}.feature-grid{grid-template-columns:repeat(2,1fr)}.section-head{align-items:start;flex-direction:column}.workflow{grid-template-columns:repeat(2,1fr)}.cta{align-items:flex-start;flex-direction:column}}
    @media(max-width:600px){.wrap{width:calc(100% - 28px)}.nav{height:68px}.brand img{width:37px;height:37px}.navlinks{gap:12px;font-size:.8rem}.navlinks>a:first-child{display:none}.navlinks .button{padding:10px 13px;font-size:.78rem}.hero{padding:48px 0 35px}h1{font-size:clamp(3rem,14vw,4.5rem)}.lead{font-size:1rem}.hero-art{min-height:330px}.hero-art:before{width:260px}.mock-screen{padding:16px}.mock-slide{min-height:165px;padding:20px}.float{font-size:.8rem;padding:9px 12px}.section{padding:60px 0}.feature-grid,.gallery,.workflow{grid-template-columns:1fr}.feature{min-height:0}.gallery{gap:12px}.footer-inner{align-items:flex-start;flex-direction:column}.cta{border-radius:20px}}
    @media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}*,*:before,*:after{transition:none!important}}
  
    .menu-toggle{display:none;border:1px solid var(--line);background:transparent;color:var(--ink);border-radius:12px;padding:10px;font-size:1.15rem;cursor:pointer}
    @media(max-width:620px){.nav{position:relative}.menu-toggle{display:block}.navlinks{display:none;position:absolute;top:100%;left:0;right:0;z-index:30;background:var(--paper);padding:18px 22px 24px;border-bottom:1px solid var(--line);flex-direction:column;align-items:stretch;gap:18px}.navlinks.open{display:flex}.navlinks .button{align-self:flex-start}.navlinks a:not(.button){display:block}}

    /* En-tête et pied de page alignés sur le style de HomeController.php */
    :root{--max:1160px}
    .topbar{position:sticky;top:0;z-index:20;background:rgba(245,240,230,.92);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}
    .nav{height:82px;display:flex;align-items:center;justify-content:space-between;gap:24px}
    .brand{display:flex;align-items:center;gap:12px;font-weight:850;letter-spacing:-.04em;font-size:1.35rem}
    .brand img{width:48px;height:48px;object-fit:contain;border-radius:12px}
    .navlinks{display:flex;align-items:center;gap:28px;font-size:.92rem;font-weight:650}
    .navlinks a:not(.button):hover{opacity:.65}
    .button{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:var(--ink);color:var(--white);padding:13px 19px;border:1px solid var(--ink);border-radius:999px;font-weight:750;font-size:.92rem;transition:transform .2s,background .2s}
    .button:hover{transform:translateY(-2px);background:#33332d}
    .button.yellow{background:var(--yellow);color:var(--ink);border-color:var(--yellow)}
    .button.outline{background:transparent;color:var(--ink)}
    .menu-toggle{display:none;border:1px solid var(--line);background:transparent;border-radius:12px;padding:10px;font-size:1.15rem}
    .footer{background:var(--ink);color:var(--white);padding:28px 0}
    .footer-inner{display:flex;justify-content:space-between;align-items:center;gap:20px;color:#aaa89e;font-size:.82rem}
    .footer-brand{display:flex;align-items:center;gap:10px;color:var(--white);font-weight:850}
    .footer-brand img{width:30px;height:30px;object-fit:contain;background:var(--paper);border-radius:8px}
    .footer-links{display:flex;gap:18px}
    .footer a:hover{color:var(--yellow)}
    .language-toggle{border:1px solid var(--line);background:transparent;color:var(--ink);border-radius:999px;padding:10px 13px;font:inherit;font-size:.82rem;font-weight:850;cursor:pointer;white-space:nowrap}
    .language-toggle:hover{background:var(--yellow);border-color:var(--yellow)}
    @media(max-width:620px){.wrap{width:min(var(--max),calc(100% - 28px))}.nav{height:72px;position:relative}.brand img{width:40px;height:40px}.menu-toggle{display:block}.navlinks{display:none;position:absolute;top:72px;left:0;right:0;z-index:30;background:var(--paper);padding:18px 22px 24px;border-bottom:1px solid var(--line);flex-direction:column;align-items:stretch;gap:18px}.navlinks.open{display:flex}.navlinks .button{align-self:flex-start}.navlinks a:not(.button){display:block}.footer-inner{align-items:flex-start;flex-direction:column}.footer-links{flex-wrap:wrap}}
  </style>
</head>
<body>
<header class="topbar">
  <div class="wrap nav">
    <a class="brand" href="/" aria-label="Hianpe, accueil"><img src="/assets/logo_hianpe.png" alt="Logo Hianpe">Hianpe</a>
    <button class="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-expanded="false">☰</button>
    <nav class="navlinks" aria-label="Navigation principale">
      <a href="/#services">Services</a><a href="/#logiciels">Logiciels</a><a href="/#approche">Notre approche</a><button class="language-toggle" type="button" aria-label="Switch to English" title="Switch to English">EN</button><a class="button" href="/contact">Parlons de votre projet <span>↗</span></a>
    </nav>
  </div>
</header>
<main>
<section class="hero"><div class="wrap hero-grid">
  <div><div class="eyebrow">Logiciel de présentation · Hianpe</div>
    <h1>Vos présentations.<br>Votre <span class="highlight">message.</span></h1>
    <p class="lead">StageFlow aide les églises et les équipes de présentation à organiser leurs diapositives, paroles, passages bibliques et médias dans un flux de travail simple.</p>
    <div class="actions"><a class="button yellow" href="https://github.com/ChrisBOUONGOU/StageFlow/releases/latest/download/StageFlow-Setup.exe">Télécharger StageFlow pour Windows ↓</a><a class="button outline" href="#captures">Voir les captures</a></div>
    <div class="trust"><span class="dot"></span>Version Windows disponible · Consultez les notes de version sur GitHub</div>
  </div>
  <div class="hero-art" aria-label="Aperçu illustratif de StageFlow">
    <span class="float one">Diapositives + médias</span>
    <div class="mock-window"><div class="mock-bar"><i></i><i></i><i></i></div><div class="mock-screen"><div class="mock-label">STAGEFLOW / PRÉSENTATION</div><div class="mock-slide"><small>VOTRE MESSAGE</small><strong>Une présentation claire.<br>Un moment mieux partagé.</strong></div><div class="mock-controls"><span></span><span></span><span></span><span></span></div></div></div>
    <span class="float two">Pensé pour le direct ✓</span>
  </div>
</div></section>
<section class="section" id="fonctionnalites"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow">Fonctionnalités</div><h2>Tout le nécessaire pour guider votre présentation.</h2></div><p>Un espace de travail pour préparer le contenu et le diffuser avec plus de clarté pendant votre événement ou votre culte.</p></div>
  <div class="feature-grid">
    <article class="feature"><div class="feature-icon">▤</div><h3>Diapositives et texte</h3><p>Préparez vos diapositives et mettez en forme le texte pour rendre chaque message lisible à l’écran.</p></article>
    <article class="feature"><div class="feature-icon">♫</div><h3>Paroles et chants</h3><p>Organisez les paroles et faites avancer le contenu au rythme de votre présentation.</p></article>
    <article class="feature"><div class="feature-icon">✦</div><h3>Passages bibliques</h3><p>Préparez des diapositives de versets pour intégrer les références bibliques à votre déroulement.</p></article>
    <article class="feature"><div class="feature-icon">▣</div><h3>Images et vidéos</h3><p>Importez vos médias dans votre projet et utilisez-les au fil de la présentation.</p></article>
    <article class="feature"><div class="feature-icon">▶</div><h3>Affichage en direct</h3><p>Passez du contenu préparé à l’affichage de présentation pour accompagner votre équipe en direct.</p></article>
    <article class="feature"><div class="feature-icon">↻</div><h3>Projets réutilisables</h3><p>Enregistrez et réouvrez vos projets pour préparer vos prochaines présentations plus efficacement.</p></article>
  </div>
</div></section>
<section class="section dark" id="captures"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow">Dans l’application</div><h2>Découvrez StageFlow en images.</h2></div><p>Des captures de l’interface pour vous familiariser avec l’espace de travail et ses outils.</p></div>
  <div class="gallery">$gallery</div>
  <p class="gallery-caption"><span id="gallery-label" data-count="$count">$galleryLabel</span> · <span>Sélectionnez une image pour l’ouvrir en grand.</span></p>
</div></section>
<section class="section dark" style="padding-top:0"><div class="wrap">
  <div class="section-head"><div><div class="eyebrow">Comment commencer</div><h2>De la préparation à la présentation.</h2></div><p>Préparez votre contenu avant l’événement, puis concentrez-vous sur le déroulement au moment voulu.</p></div>
  <div class="workflow">
    <article><div class="num">ÉTAPE 01</div><h3>Préparez</h3><p>Créez un projet et ajoutez les diapositives, paroles et passages dont vous avez besoin.</p></article>
    <article><div class="num">ÉTAPE 02</div><h3>Organisez</h3><p>Ajoutez vos images et vidéos, puis vérifiez l’ordre et la lisibilité du contenu.</p></article>
    <article><div class="num">ÉTAPE 03</div><h3>Présentez</h3><p>Ouvrez le mode Présentation et faites avancer le contenu au fil de votre programme.</p></article>
    <article><div class="num">ÉTAPE 04</div><h3>Améliorez</h3><p>Consultez les versions publiées pour retrouver les correctifs et les nouveautés.</p></article>
  </div>
</div></section>
<section class="section"><div class="wrap"><div class="cta"><div><div class="eyebrow">Prêt à essayer ?</div><h2>Préparez votre prochaine présentation avec StageFlow.</h2><p>Téléchargez l’installateur Windows ou consultez toutes les versions et les notes de publication sur GitHub.</p></div><div class="actions"><a class="button" href="https://github.com/ChrisBOUONGOU/StageFlow/releases/latest/download/StageFlow-Setup.exe">Télécharger pour Windows ↓</a><a class="button outline" href="https://github.com/ChrisBOUONGOU/StageFlow/releases" target="_blank" rel="noreferrer">Toutes les versions ↗</a></div></div></div></section>
</main>
<footer class="footer"><div class="wrap footer-inner"><a class="footer-brand" href="/" aria-label="Hianpe, accueil"><img src="/assets/logo_hianpe.png" alt="">Hianpe</a><span>© <span id="year">2026</span> Hianpe. Des solutions numériques pensées pour durer.</span><div class="footer-links"><a href="/#services">Services</a><a href="/#logiciels">Logiciels</a><a href="/#approche">Notre approche</a><a href="/contact">Contact</a></div></div></footer>
<script>
document.getElementById('year').textContent = new Date().getFullYear();
const menuToggle = document.querySelector('.menu-toggle');
const menu = document.querySelector('.navlinks');
if (menuToggle && menu) {
  menuToggle.addEventListener('click', () => {
    const isOpen = menu.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(isOpen));
    menuToggle.setAttribute('aria-label', isOpen ? 'Fermer le menu' : 'Ouvrir le menu');
    menuToggle.textContent = isOpen ? '✕' : '☰';
  });
  menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
    menu.classList.remove('open');
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-label', 'Ouvrir le menu');
    menuToggle.textContent = '☰';
  }));
}
</script>
<script>
(() => {
  const translations = {
    "Services":"Services","Logiciels":"Software","Notre approche":"Our approach",
    "Parlons de votre projet":"Let's discuss your project",
    "Développement logiciel & solutions numériques":"Software development & digital solutions",
    "Logiciel de présentation · Hianpe":"Presentation software · Hianpe",
    "Vos présentations.":"Your presentations.","Vos ":"Your ","message.":"message.",
    "StageFlow aide les églises et les équipes de présentation à organiser leurs diapositives, paroles, passages bibliques et médias dans un flux de travail simple.":"StageFlow helps churches and presentation teams organize slides, lyrics, Bible passages and media in a simple workflow.",
    "Télécharger StageFlow pour Windows ↓":"Download StageFlow for Windows ↓",
    "Voir les captures":"View screenshots","Version Windows disponible · Consultez les notes de version sur GitHub":"Windows version available · See release notes on GitHub",
    "Diapositives + médias":"Slides + media","Pensé pour le direct ✓":"Designed for live presentations ✓",
    "Fonctionnalités":"Features","Tout le nécessaire pour guider votre présentation.":"Everything you need to guide your presentation.",
    "Un espace de travail pour préparer le contenu et le diffuser avec plus de clarté pendant votre événement ou votre culte.":"A workspace to prepare content and display it clearly during your event or service.",
    "Diapositives et texte":"Slides and text","Préparez vos diapositives et mettez en forme le texte pour rendre chaque message lisible à l’écran.":"Prepare slides and format text to make every message easy to read on screen.",
    "Paroles et chants":"Lyrics and songs","Organisez les paroles et faites avancer le contenu au rythme de votre présentation.":"Organize lyrics and advance content in time with your presentation.",
    "Passages bibliques":"Bible passages","Préparez des diapositives de versets pour intégrer les références bibliques à votre déroulement.":"Prepare verse slides and integrate Bible references into your service or event.",
    "Images et vidéos":"Images and videos","Importez vos médias dans votre projet et utilisez-les au fil de la présentation.":"Import media into your project and use it throughout your presentation.",
    "Affichage en direct":"Live display","Passez du contenu préparé à l’affichage de présentation pour accompagner votre équipe en direct.":"Switch from prepared content to presentation view to support your team live.",
    "Projets réutilisables":"Reusable projects","Enregistrez et réouvrez vos projets pour préparer vos prochaines présentations plus efficacement.":"Save and reopen projects to prepare future presentations more efficiently.",
    "Dans l’application":"Inside the app","Découvrez StageFlow en images.":"Explore StageFlow in screenshots.",
    "Des captures de l’interface pour vous familiariser avec l’espace de travail et ses outils.":"Screenshots of the interface to help you get familiar with the workspace and its tools.",
    "Les captures d’écran arrivent ici.":"Screenshots will appear here.",
    "Ajoutez les images dans":"Add images to",
    ", puis envoyez ce dossier sur GitHub. La galerie les affichera automatiquement.":", then upload that folder to GitHub. The gallery will display it automatically.",
    "capture de l’application":"application screenshot","captures de l’application":"application screenshots",
    "Sélectionnez une image pour l’ouvrir en grand.":"Select an image to view it full size.",
    "Comment commencer":"Getting started","De la préparation à la présentation.":"From preparation to presentation.",
    "Préparez votre contenu avant l’événement, puis concentrez-vous sur le déroulement au moment voulu.":"Prepare your content before the event, then focus on delivering it when the time comes.",
    "ÉTAPE 01":"STEP 01","ÉTAPE 02":"STEP 02","ÉTAPE 03":"STEP 03","ÉTAPE 04":"STEP 04",
    "Préparez":"Prepare","Créez un projet et ajoutez les diapositives, paroles et passages dont vous avez besoin.":"Create a project and add the slides, lyrics and passages you need.",
    "Organisez":"Organize","Ajoutez vos images et vidéos, puis vérifiez l’ordre et la lisibilité du contenu.":"Add images and videos, then check the order and readability of your content.",
    "Présentez":"Present","Ouvrez le mode Présentation et faites avancer le contenu au fil de votre programme.":"Open Presentation mode and advance content as your program unfolds.",
    "Améliorez":"Improve","Consultez les versions publiées pour retrouver les correctifs et les nouveautés.":"Check published releases for fixes and new features.",
    "Prêt à essayer ?":"Ready to try it?",
    "Préparez votre prochaine présentation avec StageFlow.":"Prepare your next presentation with StageFlow.",
    "Téléchargez l’installateur Windows ou consultez toutes les versions et les notes de publication sur GitHub.":"Download the Windows installer or browse all releases and release notes on GitHub.",
    "Télécharger pour Windows ↓":"Download for Windows ↓","Toutes les versions ↗":"All releases ↗",
    "Hianpe. Des solutions numériques pensées pour durer.":"Hianpe. Digital solutions built to last.",
    "Ouvrir le menu":"Open menu","Fermer le menu":"Close menu","Hianpe, accueil":"Hianpe, home","Logo Hianpe":"Hianpe logo",
    "Ouvrir la capture":"Open screenshot",
    "Les captures d’écran arrivent ici.":"Screenshots will appear here."
  };
  const attributes = {
    "Ouvrir le menu":"Open menu","Fermer le menu":"Close menu",
    "Hianpe, accueil":"Hianpe, home","Logo Hianpe":"Hianpe logo",
    "Ouvrir la capture":"Open screenshot",
    "StageFlow — Présentation | Hianpe":"StageFlow — Presentation | Hianpe",
    "Découvrez StageFlow, un logiciel de présentation pour les églises et les équipes : diapositives, paroles, Bible et médias dans un flux de travail simple.":"Discover StageFlow, presentation software for churches and teams: slides, lyrics, Bible passages and media in a simple workflow."
  };
  const normalise = value => value.replace(/\\s+/g, ' ').trim();
  function setLanguage(language) {
    document.documentElement.lang = language;
    document.querySelectorAll('.language-toggle').forEach(button => {
      button.textContent = language === 'fr' ? 'EN' : 'FR';
      button.setAttribute('aria-label', language === 'fr' ? 'Switch to English' : 'Passer en français');
      button.setAttribute('title', language === 'fr' ? 'Switch to English' : 'Passer en français');
    });
    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
    let node;
    while ((node = walker.nextNode())) {
      const current = normalise(node.nodeValue);
      if (!current) continue;
      const translated = translations[current];
      if (language === 'en' && translated) {
        const leading = node.nodeValue.match(/^\\s*/)?.[0] || '';
        const trailing = node.nodeValue.match(/\\s*$/)?.[0] || '';
        node.nodeValue = leading + translated + trailing;
      } else if (language === 'fr') {
        const french = Object.keys(translations).find(key => translations[key] === current);
        if (french) {
          const leading = node.nodeValue.match(/^\\s*/)?.[0] || '';
          const trailing = node.nodeValue.match(/\\s*$/)?.[0] || '';
          node.nodeValue = leading + french + trailing;
        }
      }
    }
    document.querySelectorAll('[placeholder],[aria-label],[alt],[title],meta[name="description"]').forEach(element => {
      ['placeholder','aria-label','alt','title','content'].forEach(attr => {
        if (!element.hasAttribute(attr)) return;
        const value = element.getAttribute(attr);
        if (language === 'en' && attributes[value]) element.setAttribute(attr, attributes[value]);
        if (language === 'fr') {
          const french = Object.keys(attributes).find(key => attributes[key] === value);
          if (french) element.setAttribute(attr, french);
        }
      });
    });
    const galleryLabel = document.getElementById('gallery-label');
    if (galleryLabel) {
      const count = Number(galleryLabel.dataset.count || 0);
      galleryLabel.textContent = language === 'en' ? count + ' application screenshot' + (count === 1 ? '' : 's') : count + ' capture' + (count > 1 ? 's' : '') + ' de l’application';
    }
    document.title = language === 'en' ? 'StageFlow — Presentation | Hianpe' : 'StageFlow — Présentation | Hianpe';
    try { localStorage.setItem('hianpe-language', language); } catch (error) {}
  }
  document.querySelectorAll('.language-toggle').forEach(button => {
    button.addEventListener('click', () => {
      setLanguage(document.documentElement.lang === 'en' ? 'fr' : 'en');
    });
  });
  let saved = 'fr';
  try { saved = localStorage.getItem('hianpe-language') || 'fr'; } catch (error) {}
  setLanguage(saved === 'en' ? 'en' : 'fr');
})();
</script>
</body></html>
HTML
        , Response::HTTP_OK, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}
