import { prisma } from "../../database/client.js";

export class DeleteTiposController {
    async handle(request, response) {
        const { id } = request.body; // Desestrutura o id do request
        const tipo = await prisma.tipo.delete({ // Deleta o tipo no banco de dados
            where: {
                id: parseInt(id) // Converte o id para número
            }
        });
        return response.json(tipo); // Retorna o tipo em formato JSON
    }
}