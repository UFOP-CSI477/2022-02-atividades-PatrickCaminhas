import { prisma } from "../../database/client.js";

export class UpdatePessoasController {
    async handle(request, response) {
        const { id, nome, rua, numero, complemento,documento,cidade_id,tipo_id } = request.body;
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
    }
}