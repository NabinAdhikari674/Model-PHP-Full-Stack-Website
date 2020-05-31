//"use strict";
//<script type="text/javascript" src="arrangeColumns.js"></script>

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Classname reference
const CLASSES = {
  MASONRY: 'post-feed',
  PANEL: 'post-feed-card',
  PAD: 'masonry-pad'
};

class Masonry {
  constructor(el, _config) {
    _defineProperty(this, "reset", () => {
      const {
        container
      } = this;
      this.state.heights = [];
      const fillers = container.querySelectorAll(`.${CLASSES.PAD}`);

      if (fillers.length) {
        for (let f = 0; f < fillers.length; f++) {
          fillers[f].parentNode.removeChild(fillers[f]);
        }
      }

      container.removeAttribute('style');
    });

    _defineProperty(this, "populateHeights", () => {
      const {
        panels,
        state
      } = this;
      const {
        heights
      } = state;

      for (let p = 0; p < panels.length; p++) {
        const panel = panels[p];
        const {
          order: cssOrder,
          msFlexOrder,
          height
        } = getComputedStyle(panel);
        const order = cssOrder || msFlexOrder;
        if (!heights[order - 1]) heights[order - 1] = 0;
        heights[order - 1] += parseFloat(height, 10);
      }
    });

    _defineProperty(this, "setLayout", () => {
      const {
        container,
        state
      } = this;
      const {
        heights
      } = state;
      this.state.maxHeight = Math.max(...heights);
      container.style.height = `${this.state.maxHeight}px`;
    });

    _defineProperty(this, "getViewportCols", () => {
      const {
        config
      } = this;
      let breakpoint = 0;

      for (let b of Object.keys(config.breakpoints)) {
        if (window.innerWidth > config.breakpoints[b]) breakpoint = b;
      }

      return config.cols[breakpoint];
    });

    _defineProperty(this, "setPanelStyles", () => {
      const {
        panels
      } = this;
      const cols = this.getViewportCols(); // There needs to be an internal reference here that checks how many cols for viewport size

      for (let p = 0; p < panels.length; p++) {
        panels[p].style.order = (p + 1) % cols === 0 ? cols : (p + 1) % cols;
        panels[p].style.width = `${100 / cols}%`;
      }
    });

    _defineProperty(this, "pad", () => {
      const {
        container
      } = this;
      const {
        heights,
        maxHeight
      } = this.state;
      heights.map((height, idx) => {
        if (height < maxHeight && height > 0) {
          const pad = document.createElement('div');
          pad.className = CLASSES.PAD;
          pad.style.height = `${maxHeight - height}px`;
          pad.style.order = idx + 1;
          pad.style.msFlexOrder = idx + 1;
          container.appendChild(pad);
        }
      });
    });

    _defineProperty(this, "layout", () => {
      this.reset();
      this.setPanelStyles();
      this.populateHeights();
      this.setLayout();
      this.pad();
    });

    const {
      layout
    } = this;
    this.container = el;
    this.panels = el.children;
    this.config = _config;
    this.state = {
      heights: []
    };
    layout();
  }
  /**
   * Reset the layout by removing padding elements, resetting heights
   * reference and removing the container inline style
   */


}

const masonryConfig = {
  breakpoints: {
    sm: 430,
    md: 768,
    lg: 992,
    xl: 1500
  },
  cols: {
    sm: 1,
    md: 2,
    lg: 3,
    xl: 4
  }
};
window.myMasonry = new Masonry(document.querySelector(`.${CLASSES.MASONRY}`), masonryConfig);
/**
 * Here we can make optimizations for responding to loading images and
 * window resizing
 *
 * NOTE:: For better performance, please debounce this!
 */

window.addEventListener('resize', myMasonry.layout);
const load = imagesLoaded(myMasonry.container, () => myMasonry.layout());
load.on('progress', (instance, image) => {
  // This trick allows us to avoid any floating pixel sizes 👍
  image.img.style.height = image.img.height;
  image.img.setAttribute('height', image.img.height);
  image.img.classList.remove('loading'); // NOTE: Not the cleanest thing to do here but this is a demo 😅

  const parentPanel = image.img.parentNode.parentNode;
  parentPanel.setAttribute('style', `height: ${image.img.height}px`);
  parentPanel.classList.remove(`${CLASSES.PANEL}--loading`);
  myMasonry.layout();
});
