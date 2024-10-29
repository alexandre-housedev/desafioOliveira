<?php

namespace App\Jobs;

use App\Models\UploadFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessInfoFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uploadFileId;

    public function __construct(int $uploadFileId)
    {
        $this->uploadFileId = $uploadFileId;
    }

    public function handle(): void
    {
        // Logando o ID do arquivo para depuração
        \Log::info("Processando arquivo com ID: {$this->uploadFileId}");

        // Encontre o arquivo carregado pelo ID
        $file = UploadFile::find($this->uploadFileId);

        if (!$file) {
            \Log::error("Arquivo com ID {$this->uploadFileId} não encontrado.");
            return;
        }

        // Caminho completo do arquivo
        $filePath = storage_path('app/private/' . $file->file_path);

        // Verifica se o arquivo existe
        if (!file_exists($filePath)) {
            \Log::error("Arquivo não encontrado no caminho: {$filePath}");
            return;
        }

        // Aqui você pode adicionar a lógica de processamento do arquivo

        // Log de sucesso
        \Log::info("Arquivo com ID {$this->uploadFileId} processado com sucesso.");
    }
}
