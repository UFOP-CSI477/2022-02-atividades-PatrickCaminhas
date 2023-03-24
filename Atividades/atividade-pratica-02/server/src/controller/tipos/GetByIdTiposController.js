import {prisma} from "../../database/client.js"; // Importa o client do prisma

export class GetByIdTiposController {
    async handle(request, response) {
        const {id} = request.params; // Desestrutura o id do request
        try{
        const tipo = await prisma.tipo.findUnique({ // Busca o tipo no banco de dados
            where: {
                id: parseInt(id) // Converte o id para número
            }
        });
        return response.json(tipo); // Retorna o tipo em formato JSON
    } catch (error) {
        if (error.code === "P2025") {
          return response.status(404).json({
            message: "[GetByIdTiposController] Tipo id: ${id} não encontrado",
          });
        } else {
          return response.status(500).json({
            message: "[GetByIdLocaisController] Erro interno do servidor",
          });
        }
      }
    }
}