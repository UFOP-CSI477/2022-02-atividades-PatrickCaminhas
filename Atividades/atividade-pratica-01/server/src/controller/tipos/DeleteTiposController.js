import { prisma } from "../../database/client.js";

export class DeleteTiposController {
    async handle(request, response) {
        const { id } = request.body; // Desestrutura o id do request
        
        try{
        const tipo = await prisma.tipo.delete({ // Deleta o tipo no banco de dados
            where: {
                id: parseInt(id) // Converte o id para número
            }
        });
        return response.json(tipo); // Retorna o tipo em formato JSON
    } catch (error) {
        if (
          error.code === "P2025" 
        ) {
          return response
            .status(404)
            .json({
              message: "[DeleteTiposController] Tipo id: ${id} não encontrado",
            });
        } else {
          return response
            .status(500)
            .json({
              message: "[DeleteTiposController] Erro interno do servidor",
            });
        }
      }
    }
}