/**
 *  Light Switch @version v0.1.4
 */

(function () {
  let lightSwitch = document.getElementById('lightSwitch');
  if (!lightSwitch) {
    return;
  }

  /**
   * @function darkmode
   * @summary: changes the theme to 'dark mode' and save settings to local stroage.
   * Basically, replaces/toggles every CSS class that has '-light' class with '-dark'
   */
  function darkMode() {
    document.querySelectorAll('.bg-light').forEach((element) => {
      element.className = element.className.replace(/-light/g, '-dark');
    });

    document.querySelectorAll('.bg-white').forEach((element) => {
      element.className = element.className.replace(/-white/g, '-dark');
    });

    document.querySelectorAll('.link-dark').forEach((element) => {
      element.className = element.className.replace(/link-dark/, 'text-white');
    });

    document.querySelectorAll('.text-dark').forEach((element) => {
      element.className = element.className.replace(/text-dark/, 'text-white');
    });

    document.querySelectorAll('.works').forEach((element) => {
      element.className = element.className.replace(/works/, 'works text-success');
    });

    document.querySelectorAll('.bi-brightness-high-fill').forEach((element) => {
      element.className = element.className.replace(/bi-brightness-high-fill/, 'bi-moon-stars-fill');
    });
    
    document.querySelectorAll('.text-body-secondary').forEach((element) => {
      element.className = element.className.replace(/text-body-secondary/, 'muted text-light');
    });

    document.body.classList.add('bg-dark');

    if (document.body.classList.contains('text-dark')) {
      document.body.classList.replace('text-dark', 'text-light');
    } else {
      document.body.classList.add('text-light');
    }

    // Tables
    var tables = document.querySelectorAll('table');
    for (var i = 0; i < tables.length; i++) {
      // add table-dark class to each table
      tables[i].classList.add('table-dark');
    }

    // set light switch input to true
    if (!lightSwitch.checked) {
      lightSwitch.checked = true;
    }
    localStorage.setItem('lightSwitch', 'dark');
  }

  /**
   * @function lightmode
   * @summary: changes the theme to 'light mode' and save settings to local stroage.
   */
  function lightMode() {
    document.querySelectorAll('.bg-dark').forEach((element) => {
      element.className = element.className.replace(/-dark/g, '-light');
    });

    document.querySelectorAll('.text-white').forEach((element) => {
      element.className = element.className.replace(/text-white/, 'link-dark');
    });

    document.body.classList.add('bg-light');

    if (document.body.classList.contains('text-light')) {
      document.body.classList.replace('text-light', 'text-dark');
    } else {
      document.body.classList.add('text-dark');
    }

    document.querySelectorAll('.works').forEach((element) => {
      element.className = element.className.replace(/works text-success/, 'works');
    });

    document.querySelectorAll('.bi-moon-stars-fill').forEach((element) => {
      element.className = element.className.replace(/bi-moon-stars-fill/, 'bi-brightness-high-fill');
    });

    document.querySelectorAll('.muted').forEach((element) => {
      element.className = element.className.replace(/muted text-light/, 'text-body-secondary');
    });

    if (document.body.classList.contains('keep-white')) {
      document.body.classList.replace('keep-white', 'bg-white');
    } else {
      document.body.classList.add('bg-white');
    }

    // Tables
    var tables = document.querySelectorAll('table');
    for (var i = 0; i < tables.length; i++) {
      if (tables[i].classList.contains('table-dark')) {
        tables[i].classList.remove('table-dark');
      }
    }

    if (lightSwitch.checked) {
      lightSwitch.checked = false;

    }
    localStorage.setItem('lightSwitch', 'light');
  }

  /**
   * @function onToggleMode
   * @summary: the event handler attached to the switch. calling @darkMode or @lightMode depending on the checked state.
   */
  function onToggleMode() {
    if (lightSwitch.checked) {
      darkMode();
    } else {
      lightMode();
    }
  }

  /**
   * @function getSystemDefaultTheme
   * @summary: get system default theme by media query
   */
  function getSystemDefaultTheme() {
    const darkThemeMq = window.matchMedia('(prefers-color-scheme: dark)');
    if (darkThemeMq.matches) {
      return 'dark';
    }
    return 'light';
  }

  function setup() {
    var settings = localStorage.getItem('lightSwitch');
    if (settings == null) {
      settings = getSystemDefaultTheme();
    }

    if (settings == 'dark') {
      lightSwitch.checked = true;
    }

    lightSwitch.addEventListener('change', onToggleMode);
    onToggleMode();
  }

  setup();
})();
