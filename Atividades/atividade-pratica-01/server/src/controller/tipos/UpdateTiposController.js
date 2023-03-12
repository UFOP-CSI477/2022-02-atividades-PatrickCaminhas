import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class UpdateTiposController {
    async handle(request, response) {
        const {id,tipo,Fator} = request.body; // Desestrutura o nome do request
        const tipo_sangue = await prisma.tipo.update({ // Atualiza o tipo no banco de dados
            where: {
                id: parseInt(id) // Converte o id para número
            },
            data: {
                tipo: tipo, // Define o nome do tipo
                Fator: Fator,
                updatedAt: new Date()
            }
        });
        return response.json(tipo_sangue); // Retorna o tipo em formato JSON
    }
}