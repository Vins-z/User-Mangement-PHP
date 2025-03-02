// src/Controller/UploadController.php
#[Route('/api/upload', methods: ['POST'])]
public function upload(Request $request, EntityManagerInterface $em, MessageBusInterface $bus): Response
{
    $file = $request->files->get('file');
    $csv = Reader::createFromPath($file->getPathname());
    $csv->setHeaderOffset(0);

    foreach ($csv->getRecords() as $record) {
        $user = new User();
        $user->setName($record['name']);
        $user->setEmail($record['email']);
        // ... set other fields
        $em->persist($user);
        $bus->dispatch(new SendEmailNotification($user->getEmail()));
    }

    $em->flush();
    return new JsonResponse(['status' => 'Data uploaded']);
}