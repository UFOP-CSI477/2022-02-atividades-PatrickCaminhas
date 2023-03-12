import { prisma} from "../../database/client.js";
export class DeleteDoacoesController {
    async handle(request, response) {
        const { id } = request.body;
        const doacao = await prisma.doacoes.delete({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(doacao);
    }
}