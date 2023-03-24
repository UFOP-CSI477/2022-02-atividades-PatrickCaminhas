import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class GetAllLocaisController {
    async handle(request, response) {
        const locais = await prisma.locais.findMany(); // Busca todos os locais no banco de dados
        return response.json(locais); // Retorna os locais em formato JSON
    }
}