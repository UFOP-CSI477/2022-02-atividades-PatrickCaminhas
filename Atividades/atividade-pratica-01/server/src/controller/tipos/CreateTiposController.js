import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class CreateTiposController {
    async handle(request, response) {
        const {tipo,Fator} = request.body; // Desestrutura o nome do request
        const tipo_sangue = await prisma.tipo.create({ // Cria um tipo no banco de dados
            data: {
                tipo: tipo, // Define o nome do tipo
                Fator: Fator
            }
        });
        return response.json(tipo_sangue); // Retorna o tipo em formato JSON
    }
}