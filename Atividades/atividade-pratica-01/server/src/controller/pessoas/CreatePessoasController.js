import { prisma} from "../../database/client.js";

export class CreatePessoasController {
    async handle(request, response) {
        const {nome, rua, numero, complemento, documento, cidade_id, tipo_id } = request.body;
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
    }
}