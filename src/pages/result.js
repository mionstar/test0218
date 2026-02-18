import { createApp, defineComponent, h } from 'vue'
import FortuneResult from '../components/FortuneResult.vue'
import '../style.css'

const appEl = document.getElementById('app')
const fortuneData = JSON.parse(appEl.dataset.fortune)

const app = createApp(FortuneResult, { fortune: fortuneData })
app.mount('#app')
