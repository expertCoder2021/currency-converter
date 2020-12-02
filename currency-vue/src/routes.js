import Home from './components/index';
import listCurrency from './components/listCurrency';
import singleHistory from './components/singleHistory';
import historyOfCurrency from './components/historyOfCurrency';
import baseCurrency from './components/baseCurrency';
import line from './components/line';
export const routes = [
    {path: '/', component:Home},
    {path: '/listCurrency', component:listCurrency},
    {path: '/singleHistory/:id', component:singleHistory},
    {path: '/historyofcurrency', component:historyOfCurrency},
    {path: '/baseCurrency', component:baseCurrency},
    {path: '/line', component:line}
]