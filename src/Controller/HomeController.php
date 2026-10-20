<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response(<<<'HTML'
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Hianpe conçoit des applications sur mesure en C#/.NET, des logiciels de bureau et des solutions web modernes.">
  <meta name="theme-color" content="#171714">
  <title>Hianpe — Des solutions numériques qui vous ressemblent</title>
  <style>
    :root{--ink:#171714;--paper:#f5f0e6;--cream:#e8dcc5;--yellow:#f5c542;--muted:#6f6b62;--line:rgba(23,23,20,.14);--white:#fffdf8;--radius:22px;--max:1160px}
    *{box-sizing:border-box}html{scroll-behavior:smooth;scroll-padding-top:90px}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;line-height:1.6}a{color:inherit;text-decoration:none}button,a{ -webkit-tap-highlight-color:transparent}.wrap{width:min(var(--max),calc(100% - 40px));margin:auto}
    .topbar{position:sticky;top:0;z-index:20;background:rgba(245,240,230,.92);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}.nav{height:82px;display:flex;align-items:center;justify-content:space-between;gap:24px}.brand{display:flex;align-items:center;gap:12px;font-weight:850;letter-spacing:-.04em;font-size:1.35rem}.brand img{width:48px;height:48px;object-fit:contain;border-radius:12px}.navlinks{display:flex;align-items:center;gap:28px;font-size:.92rem;font-weight:650}.navlinks a:not(.button):hover{opacity:.65}.button{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:var(--ink);color:var(--white);padding:13px 19px;border:1px solid var(--ink);border-radius:999px;font-weight:750;font-size:.92rem;transition:transform .2s,background .2s}.button:hover{transform:translateY(-2px);background:#33332d}.button.yellow{background:var(--yellow);color:var(--ink);border-color:var(--yellow)}.button.outline{background:transparent;color:var(--ink)}.menu-toggle{display:none;border:1px solid var(--line);background:transparent;border-radius:12px;padding:10px;font-size:1.15rem}
    .hero{padding:86px 0 72px;overflow:hidden}.hero-grid{display:grid;grid-template-columns:1.1fr .9fr;align-items:center;gap:55px}.eyebrow{display:inline-flex;align-items:center;gap:9px;text-transform:uppercase;letter-spacing:.14em;font-size:.74rem;font-weight:850;color:#6b5a22}.eyebrow:before{content:"";width:26px;height:2px;background:var(--yellow)}h1,h2,h3,p{margin-top:0}h1{font-size:clamp(3rem,6.5vw,5.65rem);line-height:.99;letter-spacing:-.075em;margin:22px 0 24px;max-width:720px}h1 span{background:var(--yellow);padding:0 .12em;box-decoration-break:clone;-webkit-box-decoration-break:clone}.lead{font-size:1.14rem;max-width:590px;color:#57554e;margin-bottom:30px}.actions{display:flex;flex-wrap:wrap;gap:12px}.trustline{display:flex;align-items:center;gap:12px;margin-top:28px;color:var(--muted);font-size:.85rem}.trustdot{width:9px;height:9px;background:#4f8054;border-radius:50%;box-shadow:0 0 0 5px rgba(79,128,84,.13)}
    .visual{position:relative;min-height:450px;display:grid;place-items:center}.visual:before{content:"";position:absolute;width:370px;height:370px;border-radius:50%;background:var(--yellow);right:0;top:28px}.visual-card{position:relative;background:var(--ink);color:var(--white);width:min(100%,420px);border-radius:28px;padding:28px;box-shadow:0 30px 65px #17171420;transform:rotate(2deg)}.windowbar{display:flex;gap:6px;margin-bottom:28px}.windowbar i{width:8px;height:8px;border-radius:50%;background:#6f6e66}.windowbar i:first-child{background:var(--yellow)}.code-label{color:#a8a69b;font: .76rem ui-monospace,monospace;margin-bottom:12px}.code-line{height:9px;border-radius:20px;background:#494941;margin:12px 0;width:78%}.code-line.short{width:42%}.code-line.mid{width:60%}.code-line.yellow{background:var(--yellow);width:54%}.mini-stats{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:28px}.mini-stat{border:1px solid #41413a;border-radius:14px;padding:14px}.mini-stat strong{display:block;color:var(--yellow);font-size:1.3rem}.mini-stat small{color:#aaa89e}.floating-tag{position:absolute;background:var(--white);border:1px solid var(--line);padding:13px 17px;border-radius:15px;font-weight:800;box-shadow:0 15px 35px #17171412}.tag-one{top:35px;left:-4px}.tag-two{bottom:30px;right:-8px}.section{padding:86px 0}.section.dark{background:var(--ink);color:var(--white)}.section-head{display:flex;justify-content:space-between;align-items:end;gap:35px;margin-bottom:38px}.section-head h2{font-size:clamp(2.2rem,4vw,3.5rem);line-height:1.02;letter-spacing:-.06em;max-width:630px;margin:13px 0 0}.section-head p{max-width:390px;color:var(--muted);margin:0}.dark .section-head p{color:#b4b1a7}.cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}.service-card{padding:27px;border:1px solid var(--line);border-radius:var(--radius);background:rgba(255,253,248,.48);min-height:260px;display:flex;flex-direction:column}.service-icon{width:48px;height:48px;border-radius:15px;background:var(--yellow);display:grid;place-items:center;font-size:1.3rem;margin-bottom:28px}.service-card h3{font-size:1.22rem;letter-spacing:-.03em;margin-bottom:10px}.service-card p{color:var(--muted);font-size:.94rem;margin-bottom:20px}.card-link{margin-top:auto;font-weight:800;font-size:.9rem}.card-link span{color:#9a7710;margin-left:5px}.software-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}.software{background:#252520;border:1px solid #41413a;border-radius:var(--radius);padding:24px;display:flex;flex-direction:column;min-height:310px}.software-top{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:24px}.software-mark{width:54px;height:54px;background:var(--yellow);color:var(--ink);display:grid;place-items:center;border-radius:17px;font-weight:950;font-size:1.05rem}.pill{font-size:.7rem;letter-spacing:.04em;text-transform:uppercase;border:1px solid #5d5d53;color:#d1cec2;border-radius:999px;padding:6px 9px;font-weight:750}.software h3{font-size:1.3rem;margin-bottom:9px}.software p{color:#b7b5ab;font-size:.92rem}.software-meta{display:flex;gap:8px;flex-wrap:wrap;margin:0 0 22px}.software-meta span{font-size:.75rem;color:#d1cec2;background:#34342e;padding:5px 9px;border-radius:7px}.software .button{margin-top:auto;align-self:flex-start}.coming{background:transparent;color:var(--yellow);border-color:#656052}.software-note{font-size:.83rem;color:#aaa89e;margin:22px 0 0}
    .steps{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}.step{border-top:2px solid var(--line);padding-top:20px}.step-number{font-size:.78rem;color:#8d711d;font-weight:900;letter-spacing:.12em}.step h3{margin:15px 0 8px;font-size:1.08rem}.step p{color:var(--muted);font-size:.9rem}.cta-panel{background:var(--yellow);border-radius:28px;padding:clamp(28px,5vw,58px);display:flex;align-items:center;justify-content:space-between;gap:28px}.cta-panel h2{font-size:clamp(2.1rem,4vw,3.6rem);line-height:1;letter-spacing:-.065em;max-width:680px;margin:14px 0}.cta-panel p{max-width:520px;margin-bottom:0;color:#51451f}.cta-panel .button{background:var(--ink);color:var(--white);border-color:var(--ink);white-space:nowrap}.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:45px}.contact-grid h2{font-size:clamp(2.2rem,4vw,3.4rem);line-height:1;letter-spacing:-.06em}.contact-grid p{color:var(--muted);max-width:470px}.contact-card{background:var(--white);border:1px solid var(--line);padding:26px;border-radius:var(--radius)}.contact-card strong{display:block;font-size:1.05rem;margin-bottom:7px}.contact-card p{font-size:.9rem;margin-bottom:18px}.contact-links{display:flex;gap:10px;flex-wrap:wrap}.footer{background:var(--ink);color:var(--white);padding:28px 0}.footer-inner{display:flex;justify-content:space-between;align-items:center;gap:20px;color:#aaa89e;font-size:.82rem}.footer-brand{display:flex;align-items:center;gap:10px;color:var(--white);font-weight:850}.footer-brand img{width:30px;height:30px;object-fit:contain;background:var(--paper);border-radius:8px}.footer-links{display:flex;gap:18px}.footer a:hover{color:var(--yellow)}
    @media(max-width:850px){.hero-grid{grid-template-columns:1fr;gap:25px}.hero{padding-top:60px}.visual{min-height:390px}.visual:before{right:10%;width:300px;height:300px}.visual-card{max-width:390px}.cards,.software-grid{grid-template-columns:repeat(2,1fr)}.section-head{align-items:start;flex-direction:column}.steps{grid-template-columns:repeat(2,1fr)}.cta-panel{align-items:flex-start;flex-direction:column}.contact-grid{grid-template-columns:1fr;gap:24px}}
    @media(max-width:620px){.wrap{width:min(var(--max),calc(100% - 28px))}.nav{height:72px}.brand img{width:40px;height:40px}.menu-toggle{display:block}.navlinks{display:none;position:absolute;top:72px;left:0;right:0;background:var(--paper);padding:18px 22px 24px;border-bottom:1px solid var(--line);flex-direction:column;align-items:stretch;gap:18px}.navlinks.open{display:flex}.navlinks .button{align-self:flex-start}.hero{padding:48px 0 35px}h1{font-size:clamp(2.8rem,14vw,4.2rem)}.lead{font-size:1rem}.visual{min-height:360px}.visual:before{width:270px;height:270px;right:3%}.visual-card{padding:22px;width:calc(100% - 16px)}.tag-one{left:-3px;top:8px}.tag-two{right:-2px;bottom:6px}.section{padding:62px 0}.cards,.software-grid,.steps{grid-template-columns:1fr}.service-card{min-height:0}.software{min-height:280px}.footer-inner{align-items:flex-start;flex-direction:column}.footer-links{flex-wrap:wrap}.cta-panel{border-radius:22px}}
    @media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}*,*:before,*:after{transition:none!important}}
  </style>
</head>
<body>
<header class="topbar">
  <div class="wrap nav">
    <a class="brand" href="#accueil" aria-label="Hianpe, accueil"><img src="/assets/logo_hianpe.png" alt="Logo Hianpe">Hianpe</a>
    <button class="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-expanded="false">☰</button>
    <nav class="navlinks" aria-label="Navigation principale">
      <a href="#services">Services</a><a href="#logiciels">Logiciels</a><a href="#approche">Notre approche</a><a class="button" href="/contact">Parlons de votre projet <span>↗</span></a>
    </nav>
  </div>
</header>
<main>
  <section class="hero" id="accueil">
    <div class="wrap hero-grid">
      <div>
        <div class="eyebrow">Développement logiciel & solutions numériques</div>
        <h1>Des idées solides.<br>Des logiciels <span>utiles.</span></h1>
        <p class="lead">Hianpe accompagne vos projets numériques avec des applications sur mesure, des outils métier et des solutions web conçues pour répondre à vos vrais besoins.</p>
        <div class="actions"><a class="button" href="/contact">Parler de mon projet <span>↗</span></a><a class="button outline" href="#logiciels">Découvrir les logiciels ↓</a></div>
        <div class="trustline"><span class="trustdot"></span>Solutions pensées pour être pratiques, fiables et évolutives.</div>
      </div>
      <div class="visual" aria-label="Illustration de développement logiciel">
        <div class="floating-tag tag-one">C# · .NET</div>
        <div class="visual-card">
          <div class="windowbar"><i></i><i></i><i></i></div>
          <div class="code-label">// Une solution pensée pour vous</div>
          <div class="code-line yellow"></div><div class="code-line"></div><div class="code-line mid"></div><div class="code-line short"></div>
          <div class="mini-stats"><div class="mini-stat"><strong>Sur mesure</strong><small>Vos besoins, votre outil</small></div><div class="mini-stat"><strong>Évolutif</strong><small>Conçu pour progresser</small></div></div>
        </div>
        <div class="floating-tag tag-two">Du concept au produit ✓</div>
      </div>
    </div>
  </section>
  <section class="section" id="services">
    <div class="wrap">
      <div class="section-head"><div><div class="eyebrow">Ce que nous faisons</div><h2>La bonne technologie<br>pour le bon problème.</h2></div><p>Du premier échange à la mise en production, nous privilégions des solutions claires, maintenables et adaptées à votre réalité.</p></div>
      <div class="cards">
        <article class="service-card"><div class="service-icon">⌘</div><h3>Applications C# / .NET</h3><p>Logiciels métier, outils internes, automatisation de tâches et applications adaptées à vos processus.</p><a class="card-link" href="/contact">Décrire mon besoin <span>↗</span></a></article>
        <article class="service-card"><div class="service-icon">▣</div><h3>Applications de bureau</h3><p>Interfaces desktop modernes avec Avalonia UI et .NET, pour créer des outils multiplateformes quand le projet s'y prête.</p><a class="card-link" href="/contact">Créer un logiciel <span>↗</span></a></article>
        <article class="service-card"><div class="service-icon">⌘</div><h3>Sites et applications web</h3><p>Sites professionnels, interfaces web et applications Blazor ou ASP.NET Core orientées simplicité et performance.</p><a class="card-link" href="/contact">Lancer un projet web <span>↗</span></a></article>
        <article class="service-card"><div class="service-icon">↻</div><h3>Maintenance & évolution</h3><p>Corrections, amélioration d'interfaces, refactorisation et ajout de fonctionnalités à un projet existant.</p><a class="card-link" href="/contact">Améliorer l'existant <span>↗</span></a></article>
        <article class="service-card"><div class="service-icon">⚙</div><h3>Automatisation</h3><p>Réduisez les tâches répétitives grâce à des utilitaires et des flux de travail adaptés à votre équipe.</p><a class="card-link" href="/contact">Gagner du temps <span>↗</span></a></article>
        <article class="service-card"><div class="service-icon">◇</div><h3>Conseil technique</h3><p>Choix d'architecture, cadrage de projet et accompagnement pour avancer avec des décisions techniques éclairées.</p><a class="card-link" href="/contact">Échanger avec Hianpe <span>↗</span></a></article>
      </div>
    </div>
  </section>
  <section class="section dark" id="logiciels">
    <div class="wrap">
      <div class="section-head"><div><div class="eyebrow">Catalogue Hianpe</div><h2>Des logiciels à découvrir.<br>Un catalogue qui grandit.</h2></div><p>Retrouvez ici les applications publiées par Hianpe. Les liens de téléchargement seront ajoutés au fur et à mesure des versions officiellement disponibles.</p></div>
      <div class="software-grid">
        <article class="software"><div class="software-top"><div class="software-mark">SF</div><span class="pill">Application desktop</span></div><h3>StageFlow</h3><p>Outil de présentation conçu pour accompagner les équipes et les églises dans la gestion de leurs diapositives et médias.</p><div class="software-meta"><span>C# / .NET</span><span>Avalonia UI</span><span>Windows · Linux prévu selon version</span></div><a class="button coming" href="https://github.com/ChrisBOUONGOU/StageFlow" target="_blank" rel="noreferrer">Suivre le projet sur GitHub ↗</a></article>
        <article class="software"><div class="software-top"><div class="software-mark">APP</div><span class="pill">Outils métier</span></div><h3>Utilitaires Hianpe</h3><p>Une collection d'outils pratiques pour simplifier des tâches du quotidien et améliorer la productivité.</p><div class="software-meta"><span>Outils pratiques</span><span>Versions à venir</span></div><span class="button coming">Bientôt disponible</span></article>
        <article class="software"><div class="software-top"><div class="software-mark">DEV</div><span class="pill">Projets personnalisés</span></div><h3>Votre prochain logiciel</h3><p>Vous avez une idée d'application ou un besoin précis ? Hianpe peut étudier la création d'une solution adaptée.</p><div class="software-meta"><span>Sur mesure</span><span>C# / .NET</span></div><a class="button yellow" href="/contact">Présenter mon idée ↗</a></article>
      </div>
      <p class="software-note">Note : aucun fichier d'installation n'est proposé ici tant qu'une version vérifiée n'est pas publiée. Les plateformes compatibles et les notes de version seront précisées sur chaque fiche de téléchargement.</p>
    </div>
  </section>
  <section class="section" id="approche">
    <div class="wrap">
      <div class="section-head"><div><div class="eyebrow">Une méthode claire</div><h2>Un projet bien cadré<br>avance mieux.</h2></div><p>Une collaboration simple, avec des étapes compréhensibles et une attention portée à l'utilité du résultat final.</p></div>
      <div class="steps">
        <article class="step"><div class="step-number">ÉTAPE 01</div><h3>Comprendre</h3><p>Nous clarifions vos objectifs, vos utilisateurs et les contraintes du projet.</p></article>
        <article class="step"><div class="step-number">ÉTAPE 02</div><h3>Proposer</h3><p>Nous définissons une solution réaliste, les fonctionnalités et les priorités.</p></article>
        <article class="step"><div class="step-number">ÉTAPE 03</div><h3>Construire</h3><p>Le développement avance par étapes, avec des retours réguliers.</p></article>
        <article class="step"><div class="step-number">ÉTAPE 04</div><h3>Faire évoluer</h3><p>Nous préparons une base claire pour corriger, maintenir et améliorer le produit.</p></article>
      </div>
    </div>
  </section>
  <section class="section" style="padding-top:0">
    <div class="wrap"><div class="cta-panel"><div><div class="eyebrow">Votre projet commence ici</div><h2>Et si on construisait quelque chose d'utile ?</h2><p>Présentez votre besoin, même s'il n'est encore qu'une idée. Nous pourrons définir ensemble la prochaine étape.</p></div><a class="button" href="/contact">Discuter de votre projet ↗</a></div></div>
  </section>
  <section class="section" id="contact">
    <div class="wrap contact-grid">
      <div><div class="eyebrow">Contact</div><h2>Parlons de ce que vous voulez créer.</h2><p>Pour préparer un premier échange, pensez à préciser le problème à résoudre, les personnes qui utiliseront la solution et les fonctionnalités les plus importantes.</p></div>
      <div class="contact-card"><strong>Présentez votre projet</strong><p>Vous pouvez écrire directement à chrisbouk@outlook.fr pour présenter votre besoin, vos utilisateurs et les fonctionnalités recherchées.</p><div class="contact-links"><a class="button" href="mailto:chrisbouk@outlook.fr?subject=Demande%20de%20renseignements%20-%20Hianpe">Écrire à Hianpe ↗</a><a class="button outline" href="https://github.com/ChrisBOUONGOU/hianpe" target="_blank" rel="noreferrer">Dépôt GitHub ↗</a></div><p style="margin:16px 0 0;font-size:.9rem"><strong>Courriel :</strong> <a href="mailto:chrisbouk@outlook.fr">chrisbouk@outlook.fr</a></p></div>
    </div>
  </section>
</main>
<footer class="footer"><div class="wrap footer-inner"><a class="footer-brand" href="#accueil"><img src="/assets/logo_hianpe.png" alt="">Hianpe</a><span>© <span id="year">2026</span> Hianpe. Des solutions numériques pensées pour durer.</span><div class="footer-links"><a href="#services">Services</a><a href="#logiciels">Logiciels</a><a href="/contact">Contact</a></div></div></footer>
<script>
  const toggle=document.querySelector('.menu-toggle');const nav=document.querySelector('.navlinks');
  toggle.addEventListener('click',()=>{const open=nav.classList.toggle('open');toggle.setAttribute('aria-expanded',String(open));toggle.setAttribute('aria-label',open?'Fermer le menu':'Ouvrir le menu');toggle.textContent=open?'×':'☰'});
  nav.querySelectorAll('a').forEach(link=>link.addEventListener('click',()=>{nav.classList.remove('open');toggle.setAttribute('aria-expanded','false');toggle.textContent='☰'}));
  document.getElementById('year').textContent=new Date().getFullYear();
</script>
</body>
</html>
HTML
        , Response::HTTP_OK, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}
