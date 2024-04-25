import {parseISO,format} from 'date-fns';

export default {
    methods: {
        convertData(date) {
            if(date){
                date = parseISO(date)
                return format(date,'dd/MM/yyyy');
            }
            
        },
    },
};