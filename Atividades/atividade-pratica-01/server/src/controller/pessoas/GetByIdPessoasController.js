import { prisma} from "../../database/client.js";
export class GetByIdPessoasController {
    async handle(request, response) {
        const { id } = request.params;
        try{
        const pessoa = await prisma.pessoas.findUnique({
            where: {
                id: parseInt(id)
            }
        });
        return response.json(pessoa);
    } catch (error) {
        if (error.code === "P2025") {
          return response.status(404).json({
            message: "[GetByIdPessoasController] Pessoa id: ${id} não encontrado",
          });
        } 
        else {
          return response.status(500).json({
            message: "[GetByIdPessoasController] Erro interno do servidor",
          });
        }
      }
    }
}