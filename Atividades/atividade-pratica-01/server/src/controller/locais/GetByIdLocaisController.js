import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class GetByIdLocaisController {
    async handle(request, response) {
        const {id} = request.params; // Desestrutura o id do request
        const local = await prisma.locais.findUnique({ // Busca o local no banco de dados
            where: {
                id: parseInt(id) // Converte o id para número
            }
        });
        return response.json(local); // Retorna o local em formato JSON
    }
}