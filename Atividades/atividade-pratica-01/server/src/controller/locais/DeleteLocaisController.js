import { prisma } from "../../database/client.js";

export class DeleteLocaisController {
    async handle(request, response) {
        const { id } = request.body;
        const local = await prisma.locais.delete({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(local);
    }
}
