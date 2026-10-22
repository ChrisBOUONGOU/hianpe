<?php

namespace App\\Controller;

use Symfony\\Component\\HttpFoundation\\Response;
use Symfony\\Component\\Routing\\Attribute\\Route;

final class StageFlowController
{
    #[Route('/stageflow', name: 'stageflow', methods: ['GET'])]
    public function __invoke(): Response
    {
        $projectDir = dirname(__DIR__, 2);
        $screenshotsDir = $projectDir . '/public/assets/Sreenshots';
        $files = [];

        if (is_dir($screenshotsDir)) {
            foreach (['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif'] as $pattern) {
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
  </style>
</head>
<body>
<header class="topbar"><div class="wrap nav">
  <a class="brand" href="/"><img src="/assets/logo_hianpe.png" alt="Logo Hianpe">Hianpe <span style="color:#8b7a49;font-weight:500">/ StageFlow</span></a>
  <nav class="navlinks" aria-label="Navigation"><a href="#fonctionnalites">Fonctionnalités</a><a href="#captures">Captures</a><a href="https://github.com/ChrisBOUONGOU/StageFlow/releases" target="_blank" rel="noreferrer">Versions ↗</a><a class="button" href="https://github.com/ChrisBOUONGOU/StageFlow/releases/latest/download/StageFlow-Setup.exe">Télécharger ↓</a></nav>
</div></header>
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
  <p class="gallery-caption">$galleryLabel · Sélectionnez une image pour l’ouvrir en grand.</p>
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
<footer class="footer"><div class="wrap footer-inner"><span class="footer-brand">Hianpe · StageFlow</span><span>© <span id="year"></span> Hianpe. Tous droits réservés.</span><a href="/">Retour au site Hianpe ↗</a></div></footer>
<script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body></html>
HTML
        , Response::HTTP_OK, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}
