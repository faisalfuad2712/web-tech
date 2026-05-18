'use strict';

/* ── DARK / LIGHT MODE ─────────────────────── */

function applyTheme(theme, save) {

  document.documentElement.setAttribute('data-theme', theme);

  var icon = document.getElementById('theme-icon');

  if (icon) {
    icon.textContent = theme === 'dark' ? '☀' : '☾';
  }

  if (save) {
    localStorage.setItem('portfolio-theme', theme);
  }

}

var savedTheme =
localStorage.getItem('portfolio-theme') || 'dark';

applyTheme(savedTheme, false);

document
.getElementById('theme-toggle')
.addEventListener('click', function () {

  var current =
  document.documentElement.getAttribute('data-theme');

  applyTheme(
    current === 'dark' ? 'light' : 'dark',
    true
  );

});


/* ── PROJECT DATA ─────────────────────────── */

var projects = [

  {
    id: 1,

    title: 'Delivery Driver',

    category: 'game',

    categoryLabel: 'Game',

    description:
      'A 2D top-down delivery game built in Unity with smooth driving mechanics and obstacle challenges.',

    tags: ['Unity', 'C#', '2D Game', 'Physics'],

    emoji: '🚗',

    link:
      'https://github.com/codesbysoumik/Delivery-Driver'
  },

  {
    id: 2,

    title: 'Silicon Source POS',

    category: 'app',

    categoryLabel: 'Desktop App',

    description:
      'A smart Point-of-Sale system with inventory, billing, and sales tracking features.',

    tags: ['C#', '.NET', 'WinForms', 'OOP'],

    emoji: '🖥',

    link:
      'https://github.com/Shadipto/OOP2-Project-Silicon-Source'
  },

  {
    id: 3,

    title: 'Employee Management System',

    category: 'app',

    categoryLabel: 'Desktop App',

    description:
      'Java-based employee management software with payroll, attendance, and department management.',

    tags: ['Java', 'JDBC', 'MySQL', 'OOP'],

    emoji: '👔',

    link:
      'https://github.com/codesbysoumik/EmployeeManagementSystem'
  },

  {
    id: 4,

    title: 'Smart Farmer System',

    category: 'app',

    categoryLabel: 'Web App',

    description:
      'A smart agriculture management system for monitoring crops, irrigation, weather tracking, and farming productivity.',

    tags: ['JavaScript', 'PHP', 'MySQL', 'Smart Farming'],

    emoji: '🌾',

    link:
      'https://github.com/yourusername/farmer-system'
  }

];


/* ── RENDER PROJECTS ──────────────────────── */

function renderProjects(filter) {

  var grid =
  document.getElementById('projects-grid');

  if (!grid) return;

  var filtered =
    (!filter || filter === 'all')
      ? projects
      : projects.filter(function (p) {
          return p.category === filter;
        });

  grid.innerHTML = '';

  if (filtered.length === 0) {

    grid.innerHTML =
      '<p style="color:var(--text-muted);padding:2rem;">No projects available.</p>';

    return;
  }

  filtered.forEach(function (project, i) {

    var tagsHTML =
      project.tags.map(function (tag) {

        return `
          <span class="card-tag">
            ${tag}
          </span>
        `;

      }).join('');

    var card =
    document.createElement('article');

    card.className = 'project-card';

    card.dataset.category = project.category;

    card.style.animationDelay =
      (i * 0.1) + 's';

    card.innerHTML = `

      <div class="card-image-placeholder">
        ${project.emoji}
      </div>

      <div class="card-body">

        <span class="card-category">
          ${project.categoryLabel}
        </span>

        <h3 class="card-title">
          ${project.title}
        </h3>

        <p class="card-desc">
          ${project.description}
        </p>

        <div class="card-tags">
          ${tagsHTML}
        </div>

        <a
          href="${project.link}"
          target="_blank"
          class="card-link"
          rel="noopener"
        >
          View Project
        </a>

      </div>

    `;

    grid.appendChild(card);

  });

}

renderProjects('all');


/* ── FILTER BUTTONS ───────────────────────── */

var filterBar =
document.getElementById('filter-bar');

if (filterBar) {

  filterBar.addEventListener('click', function (e) {

    var btn =
    e.target.closest('.filter-btn');

    if (!btn) return;

    filterBar
      .querySelectorAll('.filter-btn')
      .forEach(function (b) {

        b.classList.remove('active');

      });

    btn.classList.add('active');

    renderProjects(btn.dataset.filter);

  });

}


/* ── TYPING EFFECT ────────────────────────── */

var phrases = [

  'modern web apps.',

  'beautiful UI designs.',

  'smart software solutions.',

  'Unity game projects.',

  'creative digital experiences.'

];

var typedEl =
document.getElementById('typed-text');

var pIdx = 0;
var cIdx = 0;
var isDeleting = false;

function typeLoop() {

  if (!typedEl) return;

  var phrase = phrases[pIdx];

  if (!isDeleting) {

    cIdx++;

    typedEl.textContent =
      phrase.slice(0, cIdx);

    if (cIdx === phrase.length) {

      setTimeout(function () {

        isDeleting = true;

        typeLoop();

      }, 1800);

      return;
    }

    setTimeout(typeLoop, 90);

  } else {

    cIdx--;

    typedEl.textContent =
      phrase.slice(0, cIdx);

    if (cIdx === 0) {

      isDeleting = false;

      pIdx =
      (pIdx + 1) % phrases.length;

      setTimeout(typeLoop, 400);

      return;
    }

    setTimeout(typeLoop, 50);

  }

}

typeLoop();


/* ── SCROLL BUTTON ────────────────────────── */

var scrollBtn =
document.getElementById('scroll-top');

window.addEventListener(
  'scroll',
  function () {

    if (!scrollBtn) return;

    scrollBtn.classList.toggle(
      'visible',
      window.scrollY > 400
    );

  },
  { passive: true }
);

if (scrollBtn) {

  scrollBtn.addEventListener(
    'click',
    function () {

      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });

    }
  );

}


/* ── STICKY NAV ───────────────────────────── */

var header =
document.getElementById('site-header');

window.addEventListener(
  'scroll',
  function () {

    if (!header) return;

    header.classList.toggle(
      'scrolled',
      window.scrollY > 20
    );

  },
  { passive: true }
);


/* ── MOBILE MENU ──────────────────────────── */

var hamburger =
document.getElementById('hamburger');

var mobileMenu =
document.getElementById('mobile-menu');

if (hamburger && mobileMenu) {

  hamburger.addEventListener(
    'click',
    function () {

      hamburger.classList.toggle('open');

      mobileMenu.classList.toggle('open');

    }
  );

}