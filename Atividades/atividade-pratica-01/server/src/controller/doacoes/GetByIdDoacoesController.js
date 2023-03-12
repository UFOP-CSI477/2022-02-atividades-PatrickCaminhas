import { prisma} from "../../database/client.js";

export class GetByIdDoacoesController {
    async handle(request, response) {
        const { id } = request.params;
        const doacao = await prisma.doacoes.findUnique({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(doacao);
    }
}