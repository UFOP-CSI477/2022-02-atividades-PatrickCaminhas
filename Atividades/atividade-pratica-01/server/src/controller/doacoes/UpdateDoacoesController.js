import { prisma} from "../../database/client.js";

export class UpdateDoacoesController {
    async handle(request, response) {
        const { id, pessoa_id, local_id, data } = request.body;
        const doacao = await prisma.doacoes.update({
            where: {
                id: parseInt(id)
            },
            data: {
                pessoa_id: parseInt(pessoa_id),
                local_id: parseInt(local_id),
                data: data
            }
        });
        return response.json(doacao);
    }
}