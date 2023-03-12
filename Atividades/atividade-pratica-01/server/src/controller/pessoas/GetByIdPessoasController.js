import { prisma} from "../../database/client.js";
export class GetByIdPessoasController {
    async handle(request, response) {
        const { id } = request.params;
        const pessoa = await prisma.pessoas.findUnique({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(pessoa);
    }
}