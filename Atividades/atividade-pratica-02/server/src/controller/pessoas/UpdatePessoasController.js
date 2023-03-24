import { prisma } from "../../database/client.js";

export class UpdatePessoasController {
    async handle(request, response) {
        const { id, nome, rua, numero, complemento,documento,cidade_id,tipo_id } = request.body;
        try{
        const pessoa = await prisma.pessoas.update({
            where: {
                id: parseInt(id)
            },
            data: {
                nome: nome,
                rua: rua,
                numero: numero,
                complemento: complemento,
                documento: documento,
                cidade_id: parseInt(cidade_id),
                tipo_id: parseInt(tipo_id),
                updatedAt: new Date()
            }
        });
        return response.json(pessoa);
    } catch (error) {
        if (error.code === "P2025") {
          return response.status(404).json({
            message: "[UpdatePessoasController] Pessoa id: ${id} não encontrado",
          });
        } else if(error.code === "P2003"){
            return response.status(404).json({
                message: "[UpdatePessoasController] Tipo_id: ${id} não encontrado",
              });
        } 
        else {
          return response.status(500).json({
            message: "[UpdatePessoasController] Erro interno do servidor",
          });
        }
      }
    }
}