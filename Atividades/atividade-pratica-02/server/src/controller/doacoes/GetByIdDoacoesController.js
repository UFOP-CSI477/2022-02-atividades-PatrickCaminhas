import { prisma} from "../../database/client.js";

export class GetByIdDoacoesController {
    async handle(request, response) {
        const { id } = request.params;
        try{
        const doacao = await prisma.doacoes.findUnique({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(doacao);
    } catch (error) {
        if (error.code === "P2025") {
          return response.status(404).json({
            message: "[GetByIdDoacoesController] doacao id: ${id} não encontrado",
          });
        }
        else {
          return response.status(500).json({
            message: "[UpdateDoacoesController] Erro interno do servidor",
          });
        }
      }
    }
    
}