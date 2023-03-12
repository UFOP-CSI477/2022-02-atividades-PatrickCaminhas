import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class GetByIdTiposController {
    async handle(request, response) {
        const {id} = request.params; // Desestrutura o id do request
        const tipo = await prisma.tipo.findUnique({ // Busca o tipo no banco de dados
            where: {
                id: parseInt(id) // Converte o id para número
            }
        });
        return response.json(tipo); // Retorna o tipo em formato JSON
    }
}