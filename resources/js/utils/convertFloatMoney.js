export default {
    methods: {
        convertFloatMoney(value) {
            var inteiro = null, decimal = null, c = null, j = null
            var aux = new Array()
            value = ""+value
            c = value.indexOf(".",0)

            if(c > 0){
                inteiro = value.substring(0,c)
                decimal = value.substring(c+1,value.length)
            }else{
                inteiro = value
            }
            
            
            for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
                aux[c]=inteiro.substring(j-3,j)
            }
            
            
            inteiro = ""
            for(c = aux.length-1; c >= 0; c--){
                inteiro += aux[c]+'.'
            }
            
            
            inteiro = inteiro.substring(0,inteiro.length-1)
            
            decimal = parseInt(decimal)
            if(isNaN(decimal)){
                decimal = "00"
            }else{
                decimal = ""+decimal;
                if(decimal.length === 1){
                    decimal = decimal+"0"
                }
            }
            
            
            value = "R$ "+inteiro+","+decimal
            
            
            return value
        },
    },
};