import { prisma } from "../../database/client.js";
export class UpdateLocaisController {
  async handle(request, response) {
    const { id, nome, rua, numero, complemento, cidade_id } = request.body;
    try {
      const local = await prisma.locais.update({
        where: {
          id: parseInt(id),
        },
        data: {
          nome: nome,
          rua: rua,
          numero: numero,
          complemento: complemento,
          cidade_id: parseInt(cidade_id),
          updatedAt: new Date(),
        },
      });
      return response.json(local);
    } catch (error) {
      if (error.code === "P2025") {
        return response.status(404).json({
          message: "[UpdateLocaisController] Local id: ${id} não encontrado",
        });
      } else {
        return response.status(500).json({
          message: "[UpdateLocaisController] Erro interno do servidor",
        });
      }
    }
  }
}
