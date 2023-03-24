import { prisma} from "../../database/client.js";
export class GetAllPessoasController {
    async handle(request, response) {
        const locais = await prisma.pessoas.findMany(); // Busca todos os locais no banco de dados
        return response.json(locais); // Retorna os locais em formato JSON
    }
}