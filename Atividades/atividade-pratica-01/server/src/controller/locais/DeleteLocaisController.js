import { prisma } from "../../database/client.js";

export class DeleteLocaisController {
    async handle(request, response) {
        const { id } = request.body;
        try{
        const local = await prisma.locais.delete({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(local);
    } catch (error) {
        if (error.code === "P2025") {
          return response.status(404).json({
            message: "[DeleteLocaisController] Local id: ${id} não encontrado",
          });
        } else {
          return response.status(500).json({
            message: "[DeleteLocaisController] Erro interno do servidor",
          });
        }
      }
    }
}
