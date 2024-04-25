export default {
    methods: {
        valorPacote(servico) {
            let servicos = JSON.parse(JSON.stringify(servico))
            let valorTotal = 0;

            servicos.forEach((element) => {
                valorTotal += parseFloat(element.valor)
            })
          
            
            return valorTotal
        },
    },
};