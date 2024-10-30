const showEvents = ['mouseenter', 'focus'];
const hideEvents = ['mouseleave', 'blur'];
const icon = document.querySelector('.tooltip-icon');
const tooltip = document.querySelector('#serviceAccountTip');
let popperInstance = null;

function show() {
  tooltip.setAttribute('data-show', '');
}

function hide() {
  tooltip.removeAttribute('data-show');
}

showEvents.forEach(event => {
  icon.addEventListener(event, show);
});

hideEvents.forEach(event => {
  icon.addEventListener(event, hide);
});

function create() {
  popperInstance = Popper.createPopper(icon, tooltip, {
    placement: 'bottom',
    modifiers: [{
      name: 'offset',
      options: {
        offset: [0, 8],
      },
    }],
  });
}

function destroy() {
  if (popperInstance) {
    popperInstance.destroy();
    popperInstance = null;
  }
}

function show() {
  tooltip.setAttribute('data-show', '');
  create();
}

function hide() {
  tooltip.removeAttribute('data-show');
  destroy();
}
