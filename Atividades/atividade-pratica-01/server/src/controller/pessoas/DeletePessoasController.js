import { prisma} from "../../database/client.js";

export class DeletePessoasController {
    async handle(request, response) {
        const { id } = request.body;
        const pessoa = await prisma.pessoas.delete({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(pessoa);
    }
}