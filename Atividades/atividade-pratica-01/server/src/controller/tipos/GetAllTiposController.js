import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class GetAllTiposController {
    async handle(request, response) {
        const tipos = await prisma.tipo.findMany(); // Busca todos os tipos no banco de dados
        return response.json(tipos); // Retorna os tipos em formato JSON
    }
}