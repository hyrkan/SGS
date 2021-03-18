import Calendar from './components/Dasboard_child/Calendar';
import SeedSowing from './components/Dasboard_child/SeedSowing';
import PlotMonitoring from './components/Dasboard_child/PlotMonitoring';
import Inventory from './components/Dasboard_child/Inventory';
import DashboardComponent from './components/DashboardComponent';

export default{

    mode: 'history',
    
    routes: [
        
        {
            path:'/home',
            component: Calendar
        },

        {
            path: '/seed_sow',
            component: SeedSowing
        },

        {
            path: '/plot_monitoring',
            component: PlotMonitoring
        },

        {
            path: '/inventory',
            component: Inventory
        },
        


    ]

}