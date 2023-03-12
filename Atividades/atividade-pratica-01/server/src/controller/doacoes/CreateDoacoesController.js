import { prisma } from "../../database/client.js";

export class CreateDoacoesController {
  async handle(request, response) {
    const { pessoa_id, local_id, data} = request.body;
    const doacao = await prisma.doacoes.create({
      data: {
        pessoa_id,
        data,
        local_id,
      },
    });
    return response.json(doacao);
  }
}