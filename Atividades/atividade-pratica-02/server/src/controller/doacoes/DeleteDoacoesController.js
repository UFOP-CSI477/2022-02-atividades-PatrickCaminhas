import { prisma} from "../../database/client.js";
export class DeleteDoacoesController {
    async handle(request, response) {
        const { id } = request.body;
        try{
        const doacao = await prisma.doacoes.delete({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(doacao);
    } catch (error) {
        if (error.code === "P2025") {
          return response.status(404).json({
            message: "[DeleteDoacoesController] doacao id: ${id} não encontrado",
          });
        } 
        else {
          return response.status(500).json({
            message: "[DeleteDoacoesController] Erro interno do servidor",
          });
        }
      }
    }
}