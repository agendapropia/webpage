/**
 * Tool for creating blocks for Editor.js
 *
 * @property {string} url - image source URL
 * @property {int} heightFull
 * @property {int} heightMobile
 * @property {string} caption - image caption
 * @property {boolean} withBorder - flag for adding a border
 * @property {boolean} withBackground - flag for adding a background
 * @property {boolean} stretched - flag for stretching image to the full width of content
 *
 * @typedef {object} ImageToolConfig
 * @property {string} placeholder — custom placeholder for URL field
 */
class EmbedHtml {
  /**
   * Our tool should be placed at the Toolbox, so describe an icon and title
   */
  static get toolbox() {
    return {
      title: 'Embeber Html',
      icon:
        '<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 76.5"><title>embed-code</title><path d="M47.53,61.26l.15.15a8.91,8.91,0,0,1-.18,12.46s-.11.13-.16.16a8.91,8.91,0,0,1-12.42-.1c-9.66-8.86-23.59-20-32.1-29.25a8.92,8.92,0,0,1,.11-13.12c5.41-6.71,24.44-22.15,32-29A8.93,8.93,0,0,1,49.12,13a1.66,1.66,0,0,1-.44.56l-27,24.78c4.32,4.19,8.09,7.31,11.86,10.43a172.63,172.63,0,0,1,14,12.48Zm27.82,0-.15.15a8.91,8.91,0,0,0,.18,12.46s.11.13.16.16A8.91,8.91,0,0,0,88,73.93c9.66-8.86,23.59-20,32.1-29.25A8.92,8.92,0,0,0,120,31.56c-5.41-6.71-24.44-22.15-32-29A8.93,8.93,0,0,0,73.76,13a1.77,1.77,0,0,0,.43.56l27,24.78c-4.32,4.19-8.1,7.31-11.86,10.43a172.63,172.63,0,0,0-14,12.48Z"/></svg>',
    }
  }

  /**
   * Tool class constructor
   * @param {ImageToolData} data — previously saved data
   * @param {object} api — Editor.js Core API {@link  https://editorjs.io/api}
   * @param {ImageToolConfig} config — custom config that we provide to our tool's user
   */
  constructor({ data, api, config }) {
    this.api = api
    this.config = config || {}
    this.data = {
      url: data.url || '',
      heightFull: data.heightFull || 400,
      heightMobile: data.heightMobile || 350,
      withBorder: data.withBorder !== undefined ? data.withBorder : false,
      withBackground:
        data.withBackground !== undefined ? data.withBackground : false,
      stretched: data.stretched !== undefined ? data.stretched : false,
    }

    this.blockNumber = null

    this.wrapper = undefined
    this.settings = [
      {
        name: 'withBorder',
        icon: `<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M15.8 10.592v2.043h2.35v2.138H15.8v2.232h-2.25v-2.232h-2.4v-2.138h2.4v-2.28h2.25v.237h1.15-1.15zM1.9 8.455v-3.42c0-1.154.985-2.09 2.2-2.09h4.2v2.137H4.15v3.373H1.9zm0 2.137h2.25v3.325H8.3v2.138H4.1c-1.215 0-2.2-.936-2.2-2.09v-3.373zm15.05-2.137H14.7V5.082h-4.15V2.945h4.2c1.215 0 2.2.936 2.2 2.09v3.42z"/></svg>`,
      },
      {
        name: 'stretched',
        icon: `<svg width="17" height="10" viewBox="0 0 17 10" xmlns="http://www.w3.org/2000/svg"><path d="M13.568 5.925H4.056l1.703 1.703a1.125 1.125 0 0 1-1.59 1.591L.962 6.014A1.069 1.069 0 0 1 .588 4.26L4.38.469a1.069 1.069 0 0 1 1.512 1.511L4.084 3.787h9.606l-1.85-1.85a1.069 1.069 0 1 1 1.512-1.51l3.792 3.791a1.069 1.069 0 0 1-.475 1.788L13.514 9.16a1.125 1.125 0 0 1-1.59-1.591l1.644-1.644z"/></svg>`,
      },
      {
        name: 'withBackground',
        icon: `<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.043 8.265l3.183-3.183h-2.924L4.75 10.636v2.923l4.15-4.15v2.351l-2.158 2.159H8.9v2.137H4.7c-1.215 0-2.2-.936-2.2-2.09v-8.93c0-1.154.985-2.09 2.2-2.09h10.663l.033-.033.034.034c1.178.04 2.12.96 2.12 2.089v3.23H15.3V5.359l-2.906 2.906h-2.35zM7.951 5.082H4.75v3.201l3.201-3.2zm5.099 7.078v3.04h4.15v-3.04h-4.15zm-1.1-2.137h6.35c.635 0 1.15.489 1.15 1.092v5.13c0 .603-.515 1.092-1.15 1.092h-6.35c-.635 0-1.15-.489-1.15-1.092v-5.13c0-.603.515-1.092 1.15-1.092z"/></svg>`,
      },
    ]
  }

  /**
   * Return a Tool's UI
   * @return {HTMLElement}
   */
  render() {
    this.wrapper = document.createElement('div')
    this.wrapper.classList.add('editorjs-embed-html')

    this._addModalFile()
    this.ConfigUrl = this.ModalConfig.find('input[name=url]')
    this.ConfigHeightFull = this.ModalConfig.find('input[name=height_full]')
    this.ConfigHeightMobile = this.ModalConfig.find('input[name=height_mobile]')

    this._addWrapperBase()
    this._addButtonModal()

    console.log(this.data)
    if (this.data && this.data.url) {
      this.url = this.data.url
      this.heightFull = this.data.heightFull
      this.heightMobile = this.data.heightMobile

      if (this.data.url) {
        this._createIframe()
      }
    }

    var cont = this
    this.ModalConfig.find('.btn-action').click(function () {
      if (!cont.ConfigUrl.val()) {
        return false
      }

      cont.url = cont.ConfigUrl.val()
      cont.heightFull = cont.ConfigHeightFull.val()
      cont.heightMobile = cont.ConfigHeightMobile.val()
      cont._createIframe()
      cont._openModal(false)
    })

    if (!this.data.url) {
      this._openModal()
    }

    this._acceptTuneView(true)

    setTimeout(() => {
      if (this.blockNumber) {
        this.api.blocks.stretchBlock(this.blockNumber, true)
      }
    }, 100)

    return this.wrapper
  }

  /**
   * @private
   * Add modal with template file
   */
  _addModalFile() {
    let modalNameClass =
      'modal_embed_html_' + Math.floor(Math.random() * 1000 + 1)
    let modalTemplate = $($('#template-embed-html-modal').html()).clone()
    modalTemplate.attr('class', 'modal fade modal-table-gear ' + modalNameClass)
    $('.modals-editorjs').append(modalTemplate)
    this.ModalConfig = $('.' + modalNameClass)
  }

  /**
   * @private
   * Open modal file
   */
  _openModal(status = true) {
    if (status) {
      this.ModalConfig.modal('show')
      this.ModalConfig.find('.overlay').hide()
    } else {
      this.ModalConfig.modal('hide')
      this.ModalConfig.find('.overlay').hide()
    }
  }

  /**
   * @private
   * Add base wrapper
   */
  _addWrapperBase() {
    const div = document.createElement('div')
    div.className = 'base'
    div.innerHTML = '<i class="ni ni-html5"></i>'

    this.wrapper.appendChild(div)
  }

  /**
   * @private
   * Add button open modal
   */
  _addButtonModal() {
    const button = document.createElement('button')
    button.type = 'button'
    button.innerHTML = '<i class="ni ni-html5"></i> Editar'

    button.addEventListener('click', (event) => {
      this.ConfigUrl.val(this.url)
      this.ConfigHeightFull.val(this.heightFull)
      this.ConfigHeightMobile.val(this.heightMobile)
      this._openModal()
    })

    this.wrapper.appendChild(button)
  }

  /**
   * @private
   * Create image with caption field
   * @param {array} images — image source
   * @param {object} datacomplete
   */
  _createIframe() {
    this.wrapper.innerHTML = ''
    this._addButtonModal()

    const iframe = document.createElement('iframe')
    iframe.className = 'iframe'
    iframe.setAttribute('src', this.url)
    iframe.setAttribute('height', this.heightFull)
    this.wrapper.appendChild(iframe)
  }

  /**
   * Extract data from the UI
   * @param {HTMLElement} blockContent — element returned by render method
   * @return {SimpleImageData}
   */
  save(blockContent) {
    return Object.assign(this.data, {
      url: this.url,
      heightFull: this.heightFull,
      heightMobile: this.heightMobile,
    })
  }

  /**
   * Skip empty blocks
   * @see {@link https://editorjs.io/saved-data-validation}
   * @param {ImageToolConfig} savedData
   * @return {boolean}
   */
  validate(savedData) {
    if (!savedData.url) {
      return false
    }
    return true
  }

  /**
   * Making a Block settings: 'add border', 'add background', 'stretch to full width'
   * @see https://editorjs.io/making-a-block-settings — tutorial
   * @see https://editorjs.io/tools-api#rendersettings - API method description
   * @return {HTMLDivElement}
   */
  renderSettings() {
    const wrapper = document.createElement('div')

    this.settings.forEach((tune) => {
      let button = document.createElement('div')

      button.classList.add(this.api.styles.settingsButton)
      button.classList.toggle(
        this.api.styles.settingsButtonActive,
        this.data[tune.name],
      )
      button.innerHTML = tune.icon
      wrapper.appendChild(button)

      button.addEventListener('click', () => {
        this._toggleTune(tune.name)
        button.classList.toggle(this.api.styles.settingsButtonActive)
      })
    })

    return wrapper
  }

  /**
   * @private
   * Click on the Settings Button
   * @param {string} tune — tune name from this.settings
   */
  _toggleTune(tune) {
    this.data[tune] = !this.data[tune]
    this._acceptTuneView()
  }

  /**
   * Add specified class corresponds with activated tunes
   * @private
   */
  _acceptTuneView(render = false) {
    this.settings.forEach((tune) => {
      this.wrapper.classList.toggle(tune.name, !!this.data[tune.name])

      if (tune.name === 'stretched') {
        if (this.data.stretched) {
          this.blockNumber = this.api.blocks.getCurrentBlockIndex() + 1
        }
        if (!render) {
          this.api.blocks.stretchBlock(
            this.api.blocks.getCurrentBlockIndex(),
            !!this.data.stretched,
          )
        }
      }
    })
  }
}
