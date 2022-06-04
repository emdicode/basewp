import init from './modules'

import '../css/main.css'

document.addEventListener('DOMContentLoaded', () => {
    init({
        module: 'modules'
    }).mount()
})
