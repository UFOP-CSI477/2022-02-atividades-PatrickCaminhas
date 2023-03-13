import { prisma} from "../../database/client.js";

export class CreatePessoasController {
    async handle(request, response) {
        const {nome, rua, numero, complemento, documento, cidade_id, tipo_id } = request.body;
        try{
        const pessoa = await prisma.pessoas.create({
            data: {
                nome: nome,
                rua: rua,
                numero: numero,
                complemento: complemento,
                documento: documento,
                cidade_id: parseInt(cidade_id),
                tipo_id: parseInt(tipo_id)
            }
        });
        return response.json(pessoa);
    } catch (error) {
       if(error.code === "P2003"){
            return response.status(404).json({
                message: "[CreatePessoasController] Tipo_id: ${id} não encontrado",
              });
        } 
        else {
          return response.status(500).json({
            message: "[CreatePessoasController] Erro interno do servidor",
          });
        }
      }
    }
}