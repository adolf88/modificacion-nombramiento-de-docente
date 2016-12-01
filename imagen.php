<?php
//Set up a document (PHP5 standard.)
$p = new PDFlib();
if ($p->begin_document("", "") == 0) {
     die("Error: " . $p->get_errmsg());
}
$p->set_info("Creator", "Homer");
$p->set_info("Author", "Lisa");
$p->set_info("Title", "Simpsons Image");
$p->begin_page_ext(612, 792, ""); // This is letter.

//Open the url for the image server we wish to use.
//     (When I say "Image Server," I mean any program or
//     script which will render image data as output. That
//     means that it has to output the raw data, unmodified,
//     such that it could be accessed like this in a standard
//     html instruction call:
//
//        <img src="http://site.com/getimg.php?pic=18">
//
//     If it adds border or other text, the data will be
//     corrupted, and thus cause the pdf to misrender.
if ($stream = fopen('http://site.com/getimg.php?pic=18', 'r')) {
   $MyImage= stream_get_contents($stream, -1);
   fclose($stream);
}

//First, create a PDF Virtual File (PVF) out of our data...
$pvf_filename = "/pvf/image/image1.jpg";
//and store the $MyImage data (picture data from above)
//    in it!
$p->create_pvf($pvf_filename,$MyImage, "");
//Load the image from the PVF into, er, uh, ram..., and, uh...
$image = $p->load_image("jpeg", $pvf_filename,"");
//Put it on the screen! :)
$p->fit_image($image, 100,500,"boxsize {100 100} position 50 fitmethod meet");
//Be cool and clean up after yourself...
$p->delete_pvf($pvf_filename);

//And... Render!
$p->end_page_ext("");
$p->end_document("");
$buf = $p->get_buffer();
$len = strlen($buf);
header("Content-type: application/pdf");
header("Content-Length: $len");
header("Content-Disposition: inline; filename=urlImageTest.pdf");
print $buf;
?>