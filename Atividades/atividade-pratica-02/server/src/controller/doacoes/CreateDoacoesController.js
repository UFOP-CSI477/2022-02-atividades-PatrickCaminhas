import { prisma } from "../../database/client.js";

export class CreateDoacoesController {
  async handle(request, response) {
    const { pessoa_id, local_id, data} = request.body;
   try{
    const doacao = await prisma.doacoes.create({
      data: {
        pessoa_id,
        data,
        local_id,
      },
    });
    return response.json(doacao);
  } catch (error) {
     if(error.code === "P2003"){
        return response.status(404).json({
            message: "[CreateDoacoesController] pessoa_id e/ou local_id: ${id} não encontrado",
          });
    } 
    else {
      return response.status(500).json({
        message: "[CreateDoacoesController] Erro interno do servidor",
      });
    }
  }
  }
}