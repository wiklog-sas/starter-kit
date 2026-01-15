// composer requiere league/flysystem-webdav

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\StorageAttributes;
use League\Flysystem\WebDAV\WebDAVAdapter;
use Sabre\DAV\Client;
use Session;
use Str;

$client = new Client([
    'baseUri' => config('filesystems.disks.webdav.url'),
    'userName' => config('filesystems.disks.webdav.username'),
    'password' => config('filesystems.disks.webdav.password'),
]);
$adapter = new WebDAVAdapter($client);
$filesystem = new Filesystem($adapter);

$path_root='remote.php/dav/files/' . config('filesystems.disks.webdav.username') . '/';
$recursive = false;
$directories = [];
$files=[];
try {
    $listing = $filesystem->listContents($path_root, $recursive);

    /** @var \League\Flysystem\StorageAttributes $item */
    foreach ($listing as $item) {
        $path = $item->path();

        // if ($item instanceof \League\Flysystem\FileAttributes) {
        if ($item->isFile()) {
            $files[] = Str::remove($path_root, $path);
        // } elseif ($item instanceof \League\Flysystem\DirectoryAttributes) {
        } elseif ($item->isDir()) {
            $directories[] = Str::remove($path_root, $path);
        }
    }
} catch (FilesystemException $exception) {
    Session::put('error', $exception->getMessage());
}
