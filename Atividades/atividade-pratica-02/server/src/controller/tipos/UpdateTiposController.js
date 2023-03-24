import { prisma } from "../../database/client.js"; // Importa o client do prisma

export class UpdateTiposController {
  async handle(request, response) {
    const { id, tipo, Fator } = request.body; // Desestrutura o nome do request
    try {
      const tipo_sangue = await prisma.tipo.update({
        // Atualiza o tipo no banco de dados
        where: {
          id: parseInt(id), // Converte o id para número
        },
        data: {
          tipo: tipo, // Define o nome do tipo
          Fator: Fator,
          updatedAt: new Date(),
        },
      });
      return response.json(tipo_sangue); // Retorna o tipo em formato JSON
    } catch (error) {
      if (
        error.code === "P2025" 
      ) {
        return response
          .status(404)
          .json({
            message: "[UpdateTiposController] Estado id: ${id} não encontrado",
          });
      } else {
        return response
          .status(500)
          .json({
            message: "[UpdateTiposController] Erro interno do servidor",
          });
      }
    }
  }
}
