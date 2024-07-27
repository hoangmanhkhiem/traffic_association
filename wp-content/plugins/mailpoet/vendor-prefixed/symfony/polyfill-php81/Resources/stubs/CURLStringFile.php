<?php
namespace MailPoetVendor;
if (!defined('ABSPATH')) exit;
if (\PHP_VERSION_ID >= 70400 && \extension_loaded('curl')) {
 class CURLStringFile extends \CURLFile
 {
 private $data;
 public function __construct(string $data, string $postname, string $mime = 'application/octet-stream')
 {
 $this->data = $data;
 parent::__construct('data://application/octet-stream;base64,' . \base64_encode($data), $mime, $postname);
 }
 public function __set(string $name, $value) : void
 {
 if ('data' !== $name) {
 $this->{$name} = $value;
 return;
 }
 if (\is_object($value) ? !\method_exists($value, '__toString') : !\is_scalar($value)) {
 throw new \TypeError('Cannot assign ' . \gettype($value) . ' to property CURLStringFile::$data of type string');
 }
 $this->name = 'data://application/octet-stream;base64,' . \base64_encode($value);
 }
 public function __isset(string $name) : bool
 {
 return isset($this->{$name});
 }
 public function &__get(string $name)
 {
 return $this->{$name};
 }
 }
}
